<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

class ShipmentData
{
    /**
     * @param SenderConsignee $consignee
     * @param AttributeData $attribute
     * @param PackData[] $packs
     */
    public function __construct(
        public SenderConsignee $consignee,
        public AttributeData   $attribute,
        public array           $packs
    )
    {
    }
}
