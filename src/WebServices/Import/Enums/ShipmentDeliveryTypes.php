<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Enums;

enum ShipmentDeliveryTypes: string
{
    case TheSameWorkingDay = 'tswd';         // Delivery the same working day
    case TheSameWorkingDay17_22 = 'tswd17';     // Delivery the same working day 17:00-22:00
    case NextWorkingDay = 'nwd';           // Delivery next working day
    case NextWorkingDayTill10 = 'nwd10';       // Delivery next working day till 10:00
    case NextWorkingDayTill12 = 'nwd12';       // Delivery next working day till 12:00
    case NextWorkingDay8_14 = 'nwd8_14';   // Delivery next working day 8:00-14:00
    case NextWorkingDay14_17 = 'nwd14_17'; // Delivery next working day 14:00-17:00
    case NextWorkingDay18_22 = 'nwd18_22'; // Delivery next working day 18:00-22:00
    case Saturday = 'sat';           // Delivery on Saturday
}