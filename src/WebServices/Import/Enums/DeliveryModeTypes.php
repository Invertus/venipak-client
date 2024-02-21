<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum DeliveryModeTypes: int
{
    case RegularShipment = 0;
    case ExpressShipment = 1;
}
