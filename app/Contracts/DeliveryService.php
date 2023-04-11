<?php

namespace App\Contracts;

use App\DTO\OrderData;

abstract class DeliveryService
{
    protected OrderData $orderData;

    public function __construct(OrderData $orderData)
    {
        $this->orderData = $orderData;
    }

    abstract public function calculateShippingCost();
}
