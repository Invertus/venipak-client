<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Services;

use Invertus\VenipakApiClient\WebServices\Import\DTO\AttributeData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\GlobalData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\SenderConsignee;
use SimpleXMLElement;

class AttributeGenerator
{
    public function addAttribute(SimpleXMLElement $xml, AttributeData $attributeData): void
    {
        $attributeNode = $xml->addChild('attribute');
        if ($attributeNode !== null) {
            $attributeNode->addChild('shipment_code', $attributeData->shipmentCode);
            $attributeNode->addChild('delivery_type', $attributeData->deliveryType?->value);
            $attributeNode->addChild('return_doc', (string)$attributeData->returnDoc?->value);
            $attributeNode->addChild('doc_no', (string)$attributeData->docNo);
            if ($attributeData->returnDocConsignee !== null) {
                $this->addReturnDocConsignee($attributeNode, $attributeData->returnDocConsignee);
            }
            $attributeNode->addChild('cod', (string)$attributeData->cod);
            $attributeNode->addChild('cod_type', $attributeData->codType?->value);
            $attributeNode->addChild('return_passport', (string)$attributeData->returnPassport?->value);
            $attributeNode->addChild('check_id_card', (string)$attributeData->checkIdCard?->value);
            $attributeNode->addChild('comment_door_code', (string)$attributeData->commentDoorCode);
            $attributeNode->addChild('comment_office_no', (string)$attributeData->commentOfficeNo);
            $attributeNode->addChild('comment_warehous_no', (string)$attributeData->commentWarehouseNo);
            $attributeNode->addChild('comment_call', (string)$attributeData->commentCall?->value);
            $attributeNode->addChild('comment_text', $attributeData->commentText);
            $attributeNode->addChild('insurance', (string)$attributeData->insurance);
            $attributeNode->addChild('four_hands', (string)$attributeData->fourHands);
            $attributeNode->addChild('min_age', (string)$attributeData->minAge);
            $attributeNode->addChild('return_service', (string)$attributeData->returnService);
            if ($attributeData->global !== null)
            {
                $this->addGlobal($attributeNode, $attributeData->global);
            }
        }
    }

    private function addReturnDocConsignee(SimpleXMLElement $attributeNode, SenderConsignee $returnDocConsignee): void
    {
        $returnDocConsigneeGenerator = new SenderConsigneeGenerator();
        $returnDocConsigneeGenerator->addSenderConsignee($attributeNode, 'return_doc_consignee', $returnDocConsignee);
    }

    private function addGlobal(SimpleXMLElement $attributeNode, GlobalData $global): void
    {
        $globalNode = $attributeNode->addChild('global');
        if ($globalNode !== null) {
            $globalNode->addChild('global_delivery', $global->globalDelivery->value);
            $globalNode->addChild('shipment_description', $global->shipmentDescription->value);
            $globalNode->addChild('value', (string)$global->value);
            $globalNode->addChild('eori', (string)$global->eoriCode);
        }
    }
}