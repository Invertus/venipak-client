<?php

use Invertus\VenipakApiClient\WebServices\PdfFiles\Requests\MakeLabelLinkToPdfFile;
use Saloon\Data\MultipartValue;

$packNumber = 'V17529E1234562';

$request = new MakeLabelLinkToPdfFile(
    getUserName(),
    getPassword(),
    $packNumber
);

it('check response, status and string type', function () use ($request) {
    $connector = createVenipakConnector();

    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeString();
});

it('resolves the endpoint', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/ws/print_link');
});

it('returns the default body', function () use ($request, $packNumber) {
    $expectedBody = [
        new MultipartValue('user', getUserName()),
        new MultipartValue('pass', getPassword()),
        new MultipartValue('pack_no', $packNumber)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});