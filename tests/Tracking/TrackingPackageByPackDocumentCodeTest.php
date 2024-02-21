<?php

use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingPackageTypes;
use Invertus\VenipakApiClient\WebServices\Tracking\Requests\TrackingPackageByPackDocumentCode;
use Saloon\Data\MultipartValue;

it('resolves the endpoint', function () {
    $request = new TrackingPackageByPackDocumentCode(
        'testname',
        'testpw',
        '111111',
        TrackingPackageTypes::TRACKING_PACK_BY_DOC_CODE
    );

    expect($request->resolveEndpoint())->toBe('/ws/tracking');
});

it('returns the default body', function () {
    $request = new TrackingPackageByPackDocumentCode(
        'testname',
        'testpw',
        '111111',
        TrackingPackageTypes::TRACKING_PACK_BY_DOC_CODE
    );

    $expectedBody = [
        new MultipartValue('user', 'testname'),
        new MultipartValue('pass', 'testpw'),
        new MultipartValue('code', '111111'),
        new MultipartValue('type', TrackingPackageTypes::TRACKING_PACK_BY_DOC_CODE->value)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});
