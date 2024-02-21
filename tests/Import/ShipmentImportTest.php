<?php

use Invertus\VenipakApiClient\WebServices\Import\DTO\AttributeData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\ManifestData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\PackData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\SenderConsignee;
use Invertus\VenipakApiClient\WebServices\Import\DTO\ShipmentData;
use Invertus\VenipakApiClient\WebServices\Import\DTO\ShipmentImport;
use Invertus\VenipakApiClient\WebServices\Import\Enums\CurrencyTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\DeliveryModeTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\ShipmentDeliveryTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\ShipmentDescriptionTypes;
use Invertus\VenipakApiClient\WebServices\Import\Enums\YesNoTypes;
use Invertus\VenipakApiClient\WebServices\Import\Requests\Import;
use Invertus\VenipakApiClient\WebServices\Import\Services\AttributeGenerator;
use Invertus\VenipakApiClient\WebServices\Import\Services\PackGenerator;
use Invertus\VenipakApiClient\WebServices\Import\Services\ShipmentXmlGenerator;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;
use Saloon\Data\MultipartValue;

$shipmentXmlGenerator = new ShipmentXmlGenerator(
    new AttributeGenerator(),
    new PackGenerator()
);

$consignee = new SenderConsignee(
    'consignee name',
    CountryTypes::LATVIA,
    'RIGA',
    'Vaļņu iela 18',
    '1050',
    '',
    '+37061252345',
    1234560
);

$attribute = new AttributeData(
    '12345',
    ShipmentDeliveryTypes::NextWorkingDay,
    DeliveryModeTypes::RegularShipment,
    YesNoTypes::YES,
    $consignee,
    'doc number',
    5.6,
    CurrencyTypes::Euro,
    YesNoTypes::YES,
    YesNoTypes::YES,
    'comment door code',
    'comment office no',
    'comment warehouse no',
    YesNoTypes::YES,
    'commnet text',
    1,
    1,
    20,
    0,
    null
);

$packs = [new PackData(
    'V17529E1234564',
    5.6,
    0.01,
    '',
    YesNoTypes::NO,
    YesNoTypes::YES,
    1,
    1,
    2,
    ShipmentDescriptionTypes::Documents
)];

$shipmentData = new ShipmentData(
    $consignee,
    $attribute,
    $packs
);

$manifestData = new ManifestData(
    '17529230607001',
    $shipmentData,
    'my order'
);

$xmlText = $shipmentXmlGenerator->generateXml(
    new ShipmentImport(
        $manifestData,
        $shipmentData,
        $packs
    )
);

$request = new Import(
    getUserName(),
    getPassword(),
    '',
    $xmlText
);

it('resolves the endpoint', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/import/send.php');
});

it('returns the default body', function () use ($xmlText, $request) {
    $expectedBody = [
        new MultipartValue('user', getUserName()),
        new MultipartValue('pass', getPassword()),
        new MultipartValue('xml_file', ''),
        new MultipartValue('xml_text', $xmlText)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});
