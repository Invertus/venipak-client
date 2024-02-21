<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Services;

use Invertus\VenipakApiClient\WebServices\Import\DTO\ShipmentImport;
use Invertus\VenipakApiClient\WebServices\Import\Enums\XmlDescriptionTypes;
use SimpleXMLElement;

class ShipmentXmlGenerator
{
    public function __construct(
        private readonly AttributeGenerator $attributeGenerator,
        private readonly PackGenerator      $packGenerator
    )
    {
    }

    public function generateXml(ShipmentImport $shipmentImport): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><description></description>');
        $xml->addAttribute('type', XmlDescriptionTypes::shipmentXmlDescType->value);

        $manifestNode = $xml->addChild('manifest');
        if ($manifestNode !== null) {
            $manifestNode->addAttribute('title', $shipmentImport->manifestData->manifestTitle);
            $manifestNode->addAttribute('name', $shipmentImport->manifestData->manifestName);

            $this->addManifestData($manifestNode, $shipmentImport);
        }

        return $xml->asXML();
    }

    private function addManifestData(SimpleXMLElement $xml, ShipmentImport $shipmentImport): void
    {
        if (is_array($shipmentImport->shipmentData)) {
            foreach ($shipmentImport->shipmentData as $shipment) {
                $this->addShipment($xml, $shipment);
            }
        } else {
            $this->addShipment($xml, $shipmentImport);
        }
    }

    private function addShipment(SimpleXMLElement $xml, ShipmentImport $shipmentImport): void
    {
        $shipmentNode = $xml->addChild('shipment');
        $sender = $shipmentImport->manifestData->shipmentData->consignee;
        $consignee = $shipmentImport->shipmentData->consignee;
        if ($shipmentNode !== null) {
            $senderConsigneeGenerator = new SenderConsigneeGenerator();
            $senderConsigneeGenerator->addSenderConsignee($shipmentNode, 'sender', $sender);
            $senderConsigneeGenerator->addSenderConsignee($shipmentNode, 'consignee', $consignee);
            $this->attributeGenerator->addAttribute($shipmentNode, $shipmentImport->shipmentData->attribute);
            foreach ($shipmentImport->shipmentData->packs as $pack) {
                $this->packGenerator->addAttribute($shipmentNode, $pack);
            }
        }
    }
}