<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Services;

use Invertus\VenipakApiClient\WebServices\Import\DTO\CourierInvitation;
use Invertus\VenipakApiClient\WebServices\Import\Enums\XmlDescriptionTypes;
use SimpleXMLElement;

class CourierInvitationXmlGenerator
{
    public function generateXml(CourierInvitation $courierInvitation): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><description></description>');
        $xml->addAttribute('type', XmlDescriptionTypes::courierXmlDescType->value);

        $senderConsigneeGenerator = new SenderConsigneeGenerator();
        $senderConsigneeGenerator->addSenderConsignee($xml, 'sender', $courierInvitation->sender);
        $senderConsigneeGenerator->addSenderConsignee($xml, 'consignee', $courierInvitation->consignee);

        $xml->addChild('weight', (string)$courierInvitation->weight);
        $xml->addChild('volume', (string)$courierInvitation->volume);
        $xml->addChild('pallets', (string)$courierInvitation->pallets);
        $xml->addChild('date_y', (string)$courierInvitation->dateY);
        $xml->addChild('date_m', (string)$courierInvitation->dateM);
        $xml->addChild('date_d', (string)$courierInvitation->dateD);
        $xml->addChild('hour_from', (string)$courierInvitation->hourFrom);
        $xml->addChild('min_from', (string)$courierInvitation->minFrom);
        $xml->addChild('hour_to', (string)$courierInvitation->hourTo);
        $xml->addChild('min_to', (string)$courierInvitation->minTo);
        $xml->addChild('comment', $courierInvitation->comment);
        $xml->addChild('spp', $courierInvitation->spp);
        $xml->addChild('doc_no', $courierInvitation->docNo);
        $xml->addChild('return_passport', (string)$courierInvitation->returnPassport);
        if ($courierInvitation->deliveryType !== null) {
            $xml->addChild('delivery_type', $courierInvitation->deliveryType);
            $xml->addChild('delivery_type_details', $courierInvitation->deliveryTypeDetails);
        }

        return $xml->asXML();
    }
}