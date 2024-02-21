<?php

use Invertus\VenipakApiClient\WebServices\RouteAndServices\DTO\PickupPoints;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\ViewTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Requests\GetPickupPointsList;

$request = new GetPickupPointsList(
    ViewTypes::JSON
);

it('check response, status and DTO class', function () use ($request) {
    $connector = createVenipakConnector();

    $response = $connector->send($request);
    $dto = $request->createDtoFromResponse($response);

    expect($response->status())->toBe(200);
    expect($dto[0])->toBeInstanceOf(PickupPoints::class);
});

it('resolves the endpoint for view type json', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/ws/get_pickup_points?view=json');
});