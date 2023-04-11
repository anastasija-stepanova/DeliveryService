<?php

namespace App\traits;

use ErrorException;

trait DecorateDeliveryResponseTrait
{
    /**
     * @param $response
     * @return array
     * @throws ErrorException
     */
    public function decorate($response): array
    {
        return match ($response['type']) {
            'fast' => $this->fast($response),
            'slow' => $this->slow($response),
            default => throw new ErrorException($response['type'] . "method not allowed!"),
        };
    }

    /**
     * @param $response
     * @return array
     */
    private function fast($response): array
    {
        if (isset($response['error']) && $response['error']) {
            return [
                'price' => $response['price'] ?? 0,
                'date' => $response['period'] ?? 0,
                'error' => $response['error'],
            ];
        }
        $hour = now()->format('H');
        $date = $response['period'];
        if ($hour >= 18) {
            $date++;
        }
        return [
            'price' => $response['price'] ?? 0,
            'date' => $date,
            'error' => null,
        ];
    }

    /**
     * @param $response
     * @return array
     */
    private function slow($response): array
    {
        return [
            'price' => isset($response['price']) && $response['price'] ? $response['price'] * $response['basePrice'] : 0,
            'date' => $response['period'] ?? '',
            'error' => $response['error'] ?? null,
        ];
    }
}
