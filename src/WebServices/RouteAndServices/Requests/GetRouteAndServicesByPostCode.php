<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\RouteAndServices\Requests;

use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\CountryTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\RouteServicesTypes;
use Invertus\VenipakApiClient\WebServices\RouteAndServices\Enums\ViewTypes;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRouteAndServicesByPostCode extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly CountryTypes       $countryType,
        protected readonly int                $postCode,
        protected readonly RouteServicesTypes $routeServicesType,
        protected readonly ViewTypes          $viewType
    )
    {
    }

    public function resolveEndpoint(): string
    {
        $url = '/ws/get_route';

        $params = [
            'country' => $this->countryType->value,
            'code' => $this->postCode,
            'type' => $this->routeServicesType->value,
            'view' => $this->viewType->value
        ];

        $query = http_build_query($params);

        return $url . '?' . $query;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->body();
    }
}