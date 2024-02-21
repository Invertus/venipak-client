<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

use Invertus\VenipakApiClient\WebServices\Import\Enums\CurrencyTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\DeliveryModeTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\ShipmentDeliveryTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\YesNoTypes;

class AttributeData
{
    public function __construct(
        public string                 $shipmentCode,
        public ?ShipmentDeliveryTypes $deliveryType = null,
        public ?DeliveryModeTypes     $deliveryMode = null,
        public ?YesNoTypes            $returnDoc = null,
        public ?SenderConsignee       $returnDocConsignee = null,
        public ?string                $docNo = null,
        public ?float                 $cod = null,
        public ?CurrencyTypes         $codType = null,
        public ?YesNoTypes            $returnPassport = null,
        public ?YesNoTypes            $checkIdCard = null,
        public ?string                $commentDoorCode = null,
        public ?string                $commentOfficeNo = null,
        public ?string                $commentWarehouseNo = null,
        public ?YesNoTypes            $commentCall = null,
        public ?string                $commentText = null,
        public ?int                   $insurance = null,
        public ?int                   $fourHands = null,
        public ?int                   $minAge = null,
        public ?int                   $returnService = null,
        public ?GlobalData            $global = null,
    )
    {
    }
}