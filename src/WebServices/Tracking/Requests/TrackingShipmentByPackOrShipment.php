<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Tracking\Requests;

use Invertus\VenipakApiClient\WebServices\Tracking\DTO\TrackingPackage;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingShipmentOutput;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingShipmentTypes;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class TrackingShipmentByPackOrShipment extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string                 $number,      //Pack number (V00000E0000001) or shipment number
        protected readonly TrackingShipmentTypes  $trackingShipmentType,
        protected readonly TrackingShipmentOutput $trackingShipmentOutput,
    )
    {
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
            terminal: $lineData[4]
        );
    }

    public function resolveEndpoint(): string
    {
        $url = '/ws/tracking';

        $params = [
            'code' => $this->number,
            'type' => $this->trackingShipmentType->value,
            'output' => $this->trackingShipmentOutput->value
        ];

        $query = http_build_query($params);

        return $url . '?' . $query;
    }
}