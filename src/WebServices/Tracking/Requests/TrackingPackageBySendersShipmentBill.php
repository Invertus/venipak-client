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

class TrackingPackageBySendersShipmentBill extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string               $userName,
        protected readonly string               $password,
        protected readonly string               $shipmentBillNumber,
        protected readonly TrackingPackageTypes $packageType
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/tracking';
    }

    public function createDtoFromResponse(Response $response): array
    {
        $dataLines = explode("\n", $response->body());
        array_shift($dataLines);
        $dtos = [];

        if (count($dataLines) <= 1) {
            return $dtos;
        }

        foreach ($dataLines as $line) {
            $lineData = str_getcsv(trim($line), ',', '"');
            if ($lineData[0] === null) {
                continue;
            }
            $packageNumber = $lineData[0];
            $shipmentNumber = $lineData[1];
            $date = $lineData[2];
            $status = $lineData[3];
            $terminal = $lineData[4];
            $docNo = $lineData[5];

            $dto = new TrackingPackage($packageNumber, $shipmentNumber, $date, $status, $terminal, $docNo);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('code', $this->shipmentBillNumber),
            new MultipartValue('type', TrackingPackageTypes::TRACKING_PACK_BY_SENDERS_BILL_NUMBER->value)
        ];
    }
}