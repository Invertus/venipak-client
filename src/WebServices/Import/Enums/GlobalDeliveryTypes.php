<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum GlobalDeliveryTypes: string
{
    case GlobalDelivery = 'global'; // use global delivery with the cheapest price
    case TntExpressService = 'express'; // TNT express service
    case TntEconomyExpressService = 'economy_express'; // TNT economy express service
    case GlsService = 'economy2'; // GLS service
}
