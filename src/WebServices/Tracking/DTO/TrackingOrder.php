<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Tracking\DTO;

class TrackingOrder
{
    public string $orderId;
    public string $orderSenderName;
    public string $orderSenderAddress;
    public string $orderSenderCity;
    public float $orderWeight;
    public float $orderVolume;
    public string $orderDirections;
    public string $orderArrivalFrom;
    public string $orderArrivalTo;
    public string $orderStatus;
    public string $orderStatusTxt;
    public ?string $courierName;
    public ?string $courierTel;
    public ?string $carModel;
    public ?string $carRegNo;
    public array $shipmentNo;

    public function __construct(array $data)
    {
        $this->orderId = $data['order_id'];
        $this->orderSenderName = $data['order_sender_name'];
        $this->orderSenderAddress = $data['order_sender_address'];
        $this->orderSenderCity = $data['order_sender_city'];
        $this->orderWeight = (float)$data['order_weight'];
        $this->orderVolume = (float)$data['order_volume'];
        $this->orderDirections = $data['order_directions'];
        $this->orderArrivalFrom = $data['order_arrival_from'];
        $this->orderArrivalTo = $data['order_arrival_to'];
        $this->orderStatus = $data['order_status'];
        $this->orderStatusTxt = $data['order_status_txt'];
        $this->courierName = $data['courier_name'];
        $this->courierTel = $data['courier_tel'];
        $this->carModel = $data['car_model'];
        $this->carRegNo = $data['car_reg_no'];
        $this->shipmentNo = $data['shipment_no'];
    }
}