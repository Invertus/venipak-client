<?php

namespace Invertus\VenipakApiClient\WebServices\Tracking\Enums;

enum TrackingShipmentOutput: string
{
    case STRING = 'string';
    case CSV = 'csv';
    case HTML = 'html';
}
