<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\PdfFiles\Enums;

enum PdfFormat: string
{
    case a4 = 'a4';    //  page size A4
    case other = 'other'; //  page size 100 X 150
}