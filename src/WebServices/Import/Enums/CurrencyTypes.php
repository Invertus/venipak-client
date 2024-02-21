<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum CurrencyTypes: string
{
    case Euro = 'EUR';
    case PolishZloty = 'PLN';
}