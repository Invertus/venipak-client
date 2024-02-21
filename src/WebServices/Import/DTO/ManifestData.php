<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

class ManifestData
{
    public function __construct(
        public string  $manifestTitle,
        public ShipmentData $shipmentData,
        public ?string $manifestName = null
    )
    {
    }
}
