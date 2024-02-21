<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Tracking\Requests;

use Invertus\VenipakApiClient\WebServices\Tracking\DTO\TrackingOrder;
use Invertus\VenipakApiClient\WebServices\Tracking\Enums\TrackingOrderType;
use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class TrackingOrderStatusByOrderNumber extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string            $userName,
        protected readonly string            $password,
        protected readonly string            $orderNumber,
        protected readonly TrackingOrderType $orderType
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/ws/tracking';
    }

    public function createDtoFromResponse(Response $response): TrackingOrder
    {
        return new TrackingOrder($response->json());
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('code', $this->orderNumber),
            new MultipartValue('type', TrackingOrderType::ORDER_STATUS->value)
        ];
    }
}