<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Tracking\Requests;

use Invertus\VenipakApiClient\WebServices\Tracking\DTO\TrackingPackage;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingPackageTypes;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class TrackingPackageByPackDocumentCode extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string               $userName,
        protected readonly string               $password,
        protected readonly string               $packDocumentCode,
        protected readonly TrackingPackageTypes $type
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/tracking';
    }

    public function createDtoFromResponse(Response $response): TrackingPackage
    {
        $dataLines = explode("\n", $response->body());
        array_shift($dataLines);

        if (count($dataLines) <= 1) {
            return new TrackingPackage();
        }

        $lineData = str_getcsv(trim($dataLines[0]), ',', '"');

        return new TrackingPackage(
            packageNumber: $lineData[0],
            shipmentNumber: $lineData[1],
            date: $lineData[2],
            status: $lineData[3],
            terminal: $lineData[4],
            docNo: $lineData[5]
        );
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('code', $this->packDocumentCode),
            new MultipartValue('type', TrackingPackageTypes::TRACKING_PACK_BY_DOC_CODE->value)
        ];
    }
}