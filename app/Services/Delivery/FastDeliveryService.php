<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryService;
use App\DTO\OrderData;
use App\traits\DecorateDeliveryResponseTrait;
use ErrorException;

class FastDeliveryService extends DeliveryService
{
    /**
     * Decorator trait for decorate response
     */
    use DecorateDeliveryResponseTrait;

    /**
     * @var string url of Fast Delivery provider
     */
    protected string $base_url = '';

    /**
     * @param OrderData $orderData
     */
    public function __construct(OrderData $orderData)
    {
        parent::__construct($orderData);
    }

    /**
     * @return array
     * @throws ErrorException
     */
    public function calculateShippingCost(): array
    {
        // make a request to the API of the Fast Delivery Service and get the response
        $response = [
            'price' => '5.23',
            'period' => '1',
            'error' => '',
        ];

        $response['type'] = 'fast';
        return $this->decorate($response);
    }
}
