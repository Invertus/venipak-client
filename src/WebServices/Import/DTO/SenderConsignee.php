<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\DTO;

use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;

class SenderConsignee
{
    public function __construct(
        public string       $name,
        public CountryTypes $country,
        public string       $city,
        public string       $address,
        public string       $postCode,
        public string       $contactTel,
        public ?string      $contactEmail = null,
        public ?int         $companyCode = null,
        public ?string      $contactPerson = null
    )
    {
    }
}