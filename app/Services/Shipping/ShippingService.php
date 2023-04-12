<?php

namespace App\Services\Shipping;

use App\DTO\OrderData;
use App\Models\Order;
use App\Services\Delivery\FastDeliveryService;
use App\Services\Delivery\SlowDeliveryService;
use ErrorException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ShippingService
{
    /**
     * @throws ErrorException
     */
    public static function makeShipping(array $request): array|string
    {
        try {
            $orderData = new OrderData($request);
            $result = match ($request['type']) {
                'fast' => (new FastDeliveryService($orderData))->calculateShippingCost(),
                'slow' => (new SlowDeliveryService($orderData))->calculateShippingCost(),
            };

            $order = new Order();
            $order->type = $request['type'];
            $order->sourceKladr = $request['sourceKladr'];
            $order->targetKladr = $request['targetKladr'];
            $order->weight = $request['weight'];
            $order->price = $result['price'];
            $order->date = $result['date'];
            $order->error = $result['error'];
            $order->save();

            return $result;
        } catch (UnknownProperties $e) {
            return $e->getMessage();
        }
    }
}
