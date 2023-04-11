<?php

namespace App\Contracts;

abstract class DeliveryService
{
    protected string $sourceKladr;
    protected string $targetKladr;
    protected float $weight;

    public function __construct(string $sourceKladr, string $targetKladr, float $weight)
    {
        $this->sourceKladr = $sourceKladr;
        $this->targetKladr = $targetKladr;
        $this->weight = $weight;
    }

    abstract public function calculateShippingCost();
}
