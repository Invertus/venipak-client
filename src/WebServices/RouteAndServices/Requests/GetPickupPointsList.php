<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\RouteAndServices\Requests;

use Invertus\VenipakApiClient\WebServices\RouteAndServices\DTO\PickupPoints;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\PickupTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\ViewTypes;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class GetPickupPointsList extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::GET;

    public function __construct(
        protected readonly ViewTypes     $viewType = ViewTypes::JSON,
        protected readonly ?CountryTypes $countryType = null,
        protected readonly ?string       $zip = null,
        protected readonly ?string       $city = null,
        protected readonly ?int          $companyCode = null,
        protected readonly ?int          $pickUpEnabled = null,
        protected readonly ?PickupTypes  $pickupTypes = null
    )
    {
    }

    public function resolveEndpoint(): string
    {
        $url = '/ws/get_pickup_points';

        $params = [
            'country' => $this->countryType?->value,
            'zip' => $this->zip,
            'city' => $this->city,
            'company_code' => $this->companyCode,
            'pick_up_enabled' => $this->pickUpEnabled,
            'pick_up_type' => $this->pickupTypes?->value,
            'view' => $this->viewType->value
        ];

        $query = http_build_query($params);

        return $url . '?' . $query;
    }

    public function createDtoFromResponse(Response $response): array
    {
        $responseData = $response->json();
        $pickupLocations = [];

        foreach ($responseData as $pickupData) {
            $pickupLocation = new PickupPoints(
                $pickupData['id'],
                $pickupData['name'],
                $pickupData['code'],
                $pickupData['address'],
                $pickupData['city'],
                $pickupData['zip'],
                $pickupData['country'],
                $pickupData['terminal'] ?? '',
                $pickupData['display_name'],
                $pickupData['description'] ?? '',
                $pickupData['working_hours'],
                $pickupData['contact_t'],
                $pickupData['lat'],
                $pickupData['lng'],
                $pickupData['pick_up_enabled'],
                $pickupData['cod_enabled'],
                $pickupData['ldg_enabled'],
                $pickupData['size_limit'],
                $pickupData['type'],
                $pickupData['max_height'],
                $pickupData['max_width'],
                $pickupData['max_length']
            );

            $pickupLocations[] = $pickupLocation;
        }

        return $pickupLocations;
    }

}