<?php

use Invertus\VenipakApiClient\WebServices\PdfFiles\Enums\PdfCarrier;
use Invertus\VenipakApiClient\WebServices\PdfFiles\Enums\PdfFormat;
use Invertus\VenipakApiClient\WebServices\PdfFiles\Requests\GetPackLabelPdfFile;
use Saloon\Data\MultipartValue;

$packNumber = 'V17529E1234562';

$request = new GetPackLabelPdfFile(
    getUserName(),
    getPassword(),
    $packNumber,
    null,
    PdfFormat::a4,
    PdfCarrier::all
);

it('check response, status and pdf type', function () use ($request) {
    $connector = createVenipakConnector();

    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->header('Content-Type'))->toBe('application/pdf');
});

it('resolves the endpoint', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/ws/print_label');
});

it('returns the default body', function () use ($request, $packNumber) {
    $expectedBody = [
        new MultipartValue('user', getUserName()),
        new MultipartValue('pass', getPassword()),
        new MultipartValue('format', PdfFormat::a4->value),
        new MultipartValue('carrier', PdfCarrier::all->value),
        new MultipartValue('pack_no', $packNumber)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});