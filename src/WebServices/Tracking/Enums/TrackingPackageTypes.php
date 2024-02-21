<?php

namespace Invertus\VenipakApiClient\WebServices\Tracking\Enums;

enum TrackingPackageTypes: string
{
    //    TODO check. misstype in doc?
    case TRACKING_PACK_BY_DOC_CODE = '3';
    case TRACKING_PACK_BY_SENDERS_BILL_NUMBER = '4';
}
