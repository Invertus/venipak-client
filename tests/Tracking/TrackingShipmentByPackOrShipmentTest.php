<?php

use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingShipmentOutput;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingShipmentTypes;
use Invertus\VenipakApiClient\WebServices\Tracking\Requests\TrackingShipmentByPackOrShipment;

it('resolves the endpoint with query parameters for csv', function () {
    $request = new TrackingShipmentByPackOrShipment(
        '123456',
        TrackingShipmentTypes::ALL_PACK_BELONG,
        TrackingShipmentOutput::CSV
    );

    expect($request->resolveEndpoint())->toBe('/ws/tracking?code=123456&type=2&output=csv');
});

it('resolves the endpoint with query parameters for html', function () {
    $request = new TrackingShipmentByPackOrShipment(
        '123456',
        TrackingShipmentTypes::ONLY_ASKED,
        TrackingShipmentOutput::HTML
    );

    expect($request->resolveEndpoint())->toBe('/ws/tracking?code=123456&type=1&output=html');
});
