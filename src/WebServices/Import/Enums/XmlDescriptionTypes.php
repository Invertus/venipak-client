<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum XmlDescriptionTypes: string
{
    case shipmentXmlDescType = '1'; // the type of data import when You indicate pack_no
    case courierXmlDescType = '3'; // import of orders to pick up shipment
}