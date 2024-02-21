<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices;

use Saloon\Exceptions\MissingAuthenticatorException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class VenipakConnector extends Connector
{
    use AlwaysThrowOnErrors;

    /**
     * @throws MissingAuthenticatorException
     */
    public function __construct(string $userName, string $password, private readonly string $baseUrl)
    {
        $this->validateCredentials($userName, $password);
        $this->withBasicAuth($userName, $password);
    }

    /**
     * @throws MissingAuthenticatorException
     */
    private function validateCredentials(string $userName, string $password): void
    {
        if (empty($userName) || empty($password)) {
            throw new MissingAuthenticatorException('Username and password must not be empty.');
        }
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }
}