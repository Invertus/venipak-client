<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum ShipmentDescriptionTypes: string
{
    case Documents = 'documents'; //Documents if all shipment packages contain documents
    case FreeText = 'freetext'; //Free text goods description otherwise
}
