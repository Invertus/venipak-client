<?php

namespace Invertus\VenipakApiClient\WebServices\Tracking\Enums;

enum TrackingShipmentTypes: int
{
    case ONLY_ASKED = 1;                // tracking only asked pack number
    case ALL_PACK_BELONG = 2;           // tracking all pack numbers which belong to the consignment
    case LAST_STATUS_OF_PACKAGE = 5;    // track only last status of asked package
    case ALL_PACKS_SHIPMENT = 7;        // tracking all pack numbers which belong to the shipment
}
