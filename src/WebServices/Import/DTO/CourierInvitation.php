<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

class CourierInvitation
{
    public function __construct(
        public SenderConsignee $sender,
        public SenderConsignee $consignee,
        public float $weight,
        public float $volume,
        public string $comment,
        public string $spp,
        public string $docNo,
        public ?int $pallets = null,
        public ?int $dateY = null,
        public ?int $dateM = null,
        public ?int $dateD = null,
        public ?int $hourFrom = null,
        public ?int $minFrom = null,
        public ?int $hourTo = null,
        public ?int $minTo = null,
        public ?int $returnPassport = null,
        public ?string $deliveryType = null,
        public ?string $deliveryTypeDetails = null
    ) {
    }
}