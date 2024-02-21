<?php

use Invertus\VenipakApiClient\WebServices\Import\DTO\CourierInvitation;
use Invertus\VenipakApiClient\WebServices\Import\DTO\SenderConsignee;
use Invertus\VenipakApiClient\WebServices\Import\Enums\CourierDeliveryTypes;
use Invertus\VenipakApiClient\WebServices\Import\Requests\Import;
use Invertus\VenipakApiClient\WebServices\Import\Services\CourierInvitationXmlGenerator;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;
use Saloon\Data\MultipartValue;

$courierInvitationXmlGenerator = new CourierInvitationXmlGenerator();

$sender = new SenderConsignee(
    'sender name',
    CountryTypes::LITHUANIA,
    'VILNIUS',
    'Europos pr. 81',
    '52107',
    'Artūras',
    'mail@user.to',
    12345
);

$consignee = new SenderConsignee(
    'consignee name',
    CountryTypes::LATVIA,
    'RIGA',
    'Europos pr. 81',
    '01010',
    '',
    '+37061252345',
    1234560
);

$xmlData = new CourierInvitation(
    $sender,
    $consignee,
    5.6,
    0.01,
    'Pastaba iki 50 simbolių',
    '2 boxes',
    'HF423',
    3,
    2023,
    06,
    06,
    12,
    30,
    15,
    45,
    1,
    CourierDeliveryTypes::Standart->value,
    'delivery type details'
);


$xmlText = $courierInvitationXmlGenerator->generateXml($xmlData);

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
