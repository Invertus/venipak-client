<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

use Invertus\VenipakApiClient\WebServices\Import\Enums\ShipmentDescriptionTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\YesNoTypes;

class PackData
{
    public function __construct(
        public string $packNo,
        public float $weight,
        public ?float $volume = null,
        public ?string $docNo = null,
        public ?YesNoTypes $returnTare = null,
        public ?YesNoTypes $split = null,
        public ?int $length = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?ShipmentDescriptionTypes $description = null
    )
    {
    }
}
