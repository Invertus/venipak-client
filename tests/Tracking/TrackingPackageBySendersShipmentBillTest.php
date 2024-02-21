<?php

use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingPackageTypes;
use Invertus\VenipakApiClient\WebServices\Tracking\Requests\TrackingPackageBySendersShipmentBill;
use Saloon\Data\MultipartValue;

it('resolves the endpoint', function () {
    $request = new TrackingPackageBySendersShipmentBill(
        'testname',
        'testpw',
        '111111',
        TrackingPackageTypes::TRACKING_PACK_BY_SENDERS_BILL_NUMBER
    );

    expect($request->resolveEndpoint())->toBe('/ws/tracking');
});

it('returns the default body', function () {
    $request = new TrackingPackageBySendersShipmentBill(
        'testname',
        'testpw',
        '111111',
        TrackingPackageTypes::TRACKING_PACK_BY_SENDERS_BILL_NUMBER
    );

    $expectedBody = [
        new MultipartValue('user', 'testname'),
        new MultipartValue('pass', 'testpw'),
        new MultipartValue('code', '111111'),
        new MultipartValue('type', TrackingPackageTypes::TRACKING_PACK_BY_SENDERS_BILL_NUMBER->value)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});
