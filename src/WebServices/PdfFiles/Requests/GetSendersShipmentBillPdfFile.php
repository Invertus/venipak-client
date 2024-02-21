<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\PdfFiles\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class GetSendersShipmentBillPdfFile extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string $userName,
        protected readonly string $password,
        protected readonly string $sendersShipmentBillNumber
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/print_list';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        if ($response->status() !== 200) {
            throw new RequestException($response);
        }

        return $response->body();
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('code', $this->sendersShipmentBillNumber)
        ];
    }
}