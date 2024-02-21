<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Services;

use Invertus\VenipakApiClient\WebServices\Import\DTO\SenderConsignee;
use SimpleXMLElement;

class SenderConsigneeGenerator
{
    public function addSenderConsignee(SimpleXMLElement $xml, string $nodeName, SenderConsignee $senderConsignee): void
    {
        $senderConsigneeNode = $xml->addChild($nodeName);
        if ($senderConsigneeNode !== null) {
            $senderConsigneeNode->addChild('name', $senderConsignee->name);
            $senderConsigneeNode->addChild('company_code', (string)$senderConsignee->companyCode);
            $senderConsigneeNode->addChild('country', $senderConsignee->country->value);
            $senderConsigneeNode->addChild('city', $senderConsignee->city);
            $senderConsigneeNode->addChild('address', $senderConsignee->address);
            $senderConsigneeNode->addChild('post_code', (string)$senderConsignee->postCode);
            $senderConsigneeNode->addChild('contact_person', $senderConsignee->contactPerson);
            $senderConsigneeNode->addChild('contact_tel', $senderConsignee->contactTel);
            $senderConsigneeNode->addChild('contact_email', $senderConsignee->contactEmail);
        }
    }
}