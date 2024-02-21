<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\RouteAndServices\DTO;

class PickupPoints
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $code,
        public string $address,
        public string $city,
        public string $zip,
        public string $country,
        public string $terminal,
        public string $displayName,
        public string $description,
        public string $workingHours,
        public string $contactT,
        public string $lat,
        public string $lng,
        public int    $pickupEnabled,
        public int    $codEnabled,
        public int    $ldgEnabled,
        public int    $sizeLimit,
        public int    $type,
        public float  $maxHeight,
        public float  $maxWidth,
        public float  $maxLength
    )
    {
    }
}
