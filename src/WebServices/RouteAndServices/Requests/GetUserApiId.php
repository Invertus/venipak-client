<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\RouteAndServices\Requests;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserApiId extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string $userName,
        protected readonly string $password
    )
    {
    }

    public function resolveEndpoint(): string
    {
        $url = '/ws/get_api_id';

        $params = [
            'user' => $this->userName,
            'pass' => $this->password
        ];

        $query = http_build_query($params);

        return $url . '?' . $query;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->body();
    }
}