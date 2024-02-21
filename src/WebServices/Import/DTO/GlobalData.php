<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

use Invertus\VenipakApiClient\WebServices\Import\Enums\GlobalDeliveryTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\ShipmentDescriptionTypes;

class GlobalData
{
    public function __construct(
        public GlobalDeliveryTypes      $globalDelivery,
        public ShipmentDescriptionTypes $shipmentDescription,
        public int                      $value,
        public ?string                  $eoriCode = null
    )
    {
    }
}
