<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Tracking\DTO;

class TrackingPackage
{
    public function __construct(
        public ?string $packageNumber = null,
        public ?string $shipmentNumber = null,
        public ?string $date = null,
        public ?string $status = null,
        public ?string $terminal = null,
        public ?string $docNo = null
    )
    {
    }
}