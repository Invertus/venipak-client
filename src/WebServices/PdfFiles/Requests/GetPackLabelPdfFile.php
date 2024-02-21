<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\PdfFiles\Requests;

use Invertus\VenipakApiClient\WebServices\PdfFiles\Enums\PdfCarrier;
use Invertus\VenipakApiClient\WebServices\PdfFiles\Enums\PdfFormat;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class GetPackLabelPdfFile extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string            $userName,
        protected readonly string            $password,
        protected readonly string|array|null $packNumber = null,
        protected readonly string|array|null $sendersShipmentBillNumber = null,
        protected readonly PdfFormat         $format = PdfFormat::a4,
        protected readonly PdfCarrier        $carrier = PdfCarrier::venipak
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/print_label';
    }

    /**
     * @throws RequestException
     */
    public function createDtoFromResponse(Response $response): string
    {
        if ($response->status() !== 200) {
            throw new RequestException($response);
        }

        return $response->body();
    }

    protected function defaultBody(): array
    {
        $body = [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('format', $this->format->value),
            new MultipartValue('carrier', $this->carrier->value),
        ];

        if ($this->packNumber !== null) {
            if (is_array($this->packNumber)) {
                foreach ($this->packNumber as $pack) {
                    $body[] = new MultipartValue('pack_no', $pack);
                }
            } else {
                $body[] = new MultipartValue('pack_no', $this->packNumber);
            }
        } elseif ($this->sendersShipmentBillNumber !== null) {
            if (is_array($this->sendersShipmentBillNumber)) {
                foreach ($this->sendersShipmentBillNumber as $code) {
                    $body[] = new MultipartValue('code', $code);
                }
            } else {
                $body[] = new MultipartValue('code', $this->sendersShipmentBillNumber);
            }
        }

        return $body;
    }
}