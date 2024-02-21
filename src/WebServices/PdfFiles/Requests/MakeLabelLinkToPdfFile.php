<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\PdfFiles\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class MakeLabelLinkToPdfFile extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string       $userName,
        protected readonly string       $password,
        protected readonly string|array $packNumber
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/print_link';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->body();
    }

    protected function defaultBody(): array
    {
        $body = [];
        $body += [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
        ];
        if (is_array($this->packNumber)) {
            foreach ($this->packNumber as $packNumber) {
                $body[] = new MultipartValue('pack_no', $packNumber);
            }
        } else {
            $body[] = new MultipartValue('pack_no', $this->packNumber);
        }

        return $body;
    }
}