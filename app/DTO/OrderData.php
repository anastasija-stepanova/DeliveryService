<?php

namespace App\DTO;

use App\Http\Requests\Shipping\ShippingRequest;
use App\Models\Order;
use App\Parents\ObjectData;

final class OrderData extends ObjectData
{
    public string $type;
    public string $sourceKladr;
    public string $targetKladr;
    public float $weight;

    public static function fromRequest(ShippingRequest $request): self
    {
        return new self([
            'type' => $request->get('type'),
            'sourceKladr' => $request->get('sourceKladr'),
            'targetKladr' => $request->get('targetKladr'),
            'weight' => $request->get('weight'),
        ]);
    }

    public static function fromModel(Order $order): self
    {
        return new static([
            'id' => $order->id,
            'type' => $order->type,
            'sourceKladr' => $order->sourceKladr,
            'targetKladr' => $order->targetKladr,
            'weight' => $order->weight,
            'price' => $order->price,
            'date' => $order->date,
            'error' => $order->error,
        ]);
    }
}
