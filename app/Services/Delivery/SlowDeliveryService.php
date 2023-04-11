<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryService;
use App\DTO\OrderData;
use App\traits\DecorateDeliveryResponseTrait;
use ErrorException;

class SlowDeliveryService extends DeliveryService
{
    /**
     * Decorator trait for decorate response
     */
    use DecorateDeliveryResponseTrait;

    protected string $base_url = '';

    protected int $basePrice = 150;

    /**
     * @param OrderData $orderData
     */
    public function __construct(OrderData $orderData)
    {
        parent::__construct($orderData);
    }

    /**
     * @throws ErrorException
     */
    public function calculateShippingCost(): array
    {
        // make a request to the API of the Fast Delivery Service and get the response
        $response = [
            'price'=> '5.23',
            'period'=> '5',
            'error'=> '',
        ];

        $response['basePrice'] = $this->basePrice;
        $response['type'] = 'slow';

        return $this->decorate($response);
    }
}
