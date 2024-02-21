<?php

namespace Invertus\VenipakApiClient\WebServices\PdfFiles\Enums;

enum PdfCarrier: string
{
    case venipak = 'venipak'; // default option
    case global = 'global';  // only labels prepared by global carriers
    case all = 'all';     // all labels prepared by Venipak and Global carriers
}
