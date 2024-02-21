<?php

use Invertus\VenipakApiClient\WebServices\Tracking\DTO\TrackingOrder;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingOrderType;
use Invertus\VenipakApiClient\WebServices\Tracking\Requests\TrackingOrderStatusByOrderNumber;
use Invertus\VenipakApiClient\WebServices\VenipakConnector;
use Saloon\Data\MultipartValue;

it('check response, status and DTO class', function () {
    $connector = createVenipakConnector();
    $connector->withMockClient(mockClient());

    $request = new TrackingOrderStatusByOrderNumber(
        'testname',
        'testpw',
        '4250102',
        TrackingOrderType::ORDER_STATUS
    );

    $response = $connector->send($request);
    $dto = $request->createDtoFromResponse($response);

    expect($response->status())->toBe(200);
    expect($response->json('order_id'))->toEqual('4250102');
    expect($dto)->toBeInstanceOf(TrackingOrder::class);
});

it('resolves the endpoint', function () {
    $request = new TrackingOrderStatusByOrderNumber(
        'testname',
        'testpw',
        '12345',
        TrackingOrderType::ORDER_STATUS
    );

    expect($request->resolveEndpoint())->toBe('/ws/tracking');
});

it('returns the default body', function () {
    $request = new TrackingOrderStatusByOrderNumber(
        'testname',
        'testpw',
        '12345',
        TrackingOrderType::ORDER_STATUS
    );

    $expectedBody = [
        new MultipartValue('user', 'testname'),
        new MultipartValue('pass', 'testpw'),
        new MultipartValue('code', '12345'),
        new MultipartValue('type', TrackingOrderType::ORDER_STATUS->value)
    ];

    $reflectionClass = new ReflectionClass($request);
    $defaultBodyMethod = $reflectionClass->getMethod('defaultBody');
    $defaultBodyMethod->setAccessible(true);

    $actualBody = $defaultBodyMethod->invoke($request);

    expect($actualBody)->toEqual($expectedBody);
});
