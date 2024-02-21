<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum CourierDeliveryTypes: string
{
    case Standart = 'standart'; // default option
    case TheSameWorkingDay = 'tswd';  // same-day delivery

}