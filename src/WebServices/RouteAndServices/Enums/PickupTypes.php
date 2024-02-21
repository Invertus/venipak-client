<?php

namespace Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums;

enum PickupTypes: string
{
    case PICKUP_POINTS = '1';
    case LOCKERS = '3';
    case PICKUP_POINTS_AND_LOCKERS = '1,3';
}
