<?php declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Services;

use Invertus\VenipakApiClient\WebServices\Import\DTO\PackData;
use SimpleXMLElement;

class PackGenerator
{
    public function addAttribute(SimpleXMLElement $xml, PackData $packData): void
    {
        $packNode = $xml->addChild('pack');
        if ($packNode !== null) {
            $returnTare = $packData->returnTare;
            $packNode->addChild('pack_no', $packData->packNo);
            $packNode->addChild('doc_no', $packData->docNo);
            $packNode->addChild('weight', (string)$packData->weight);
            $packNode->addChild('volume', (string)$packData->volume);
            $packNode->addChild('return_tare', $returnTare ? (string) $returnTare->value : '0');
        }
    }
}
