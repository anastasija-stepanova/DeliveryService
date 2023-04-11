<?php

namespace App\Services\Delivery;

use App\Contracts\DeliveryService;
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
     * @param string $sourceKladr
     * @param string $targetKladr
     * @param float $weight
     */
    public function __construct(string $sourceKladr, string $targetKladr, float $weight)
    {
        parent::__construct($sourceKladr, $targetKladr, $weight);
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
