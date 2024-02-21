<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

class ShipmentImport
{
    /**
     * @param ManifestData $manifestData
     * @param ShipmentData $shipmentData
     * @param PackData[] $packs
     */
    public function __construct(
        public ManifestData $manifestData,
        public ShipmentData $shipmentData,
        public array        $packs
    ) {
    }
}