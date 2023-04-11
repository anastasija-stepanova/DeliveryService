<?php

namespace App\Services\Shipping;

use App\Models\Order;
use App\Services\Delivery\FastDeliveryService;
use App\Services\Delivery\SlowDeliveryService;
use ErrorException;

class ShippingService
{
    /**
     * @throws ErrorException
     */
    public static function makeShipping($request) {
        $result =  match ($request['type']) {
            'fast' => (new FastDeliveryService($request['sourceKladr'], $request['targetKladr'], $request['weight']))->calculateShippingCost(),
            'slow' => (new SlowDeliveryService($request['sourceKladr'], $request['targetKladr'], $request['weight']))->calculateShippingCost(),
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
    }
}
