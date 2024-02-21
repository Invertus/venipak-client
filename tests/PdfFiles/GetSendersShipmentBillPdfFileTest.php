<?php

use Invertus\VenipakApiClient\WebServices\PdfFiles\Requests\GetSendersShipmentBillPdfFile;
use Saloon\Data\MultipartValue;

$senderShipmentBillNumber = '17529230607001';

$request = new GetSendersShipmentBillPdfFile(
    getUserName(),
    getPassword(),
    $senderShipmentBillNumber
);

it('check response, status and pdf type', function () use ($request) {
    $connector = createVenipakConnector();

    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->header('Content-Type'))->toBe('application/pdf');
});

it('resolves the endpoint', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/ws/print_list');
});

it('returns the default body', function () use ($request, $senderShipmentBillNumber) {
    $expectedBody = [
        new MultipartValue('user', getUserName()),
        new MultipartValue('pass', getPassword()),
        new MultipartValue('code', $senderShipmentBillNumber)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});