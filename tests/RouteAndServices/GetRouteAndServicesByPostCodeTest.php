<?php

use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\RouteServicesTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\ViewTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Requests\GetRouteAndServicesByPostCode;

$request = new GetRouteAndServicesByPostCode(
    CountryTypes::LITHUANIA,
    1010,
    RouteServicesTypes::ALL,
    ViewTypes::JSON
);

it('check response, status and json type', function () use ($request) {
    $connector = createVenipakConnector();

    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();
});

it('resolves the endpoint', function () use ($request) {
    expect($request->resolveEndpoint())->toBe('/ws/get_route?country=LT&code=1010&type=all&view=json');
});