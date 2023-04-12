<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shipping\ShippingRequest;
use App\Services\Shipping\ShippingService;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ShippingController extends Controller
{
    /**
     * @param ShippingRequest $request
     * @return RedirectResponse|JsonResponse
     * @throws ErrorException
     */
    public function shipping(ShippingRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        $result = ShippingService::makeShipping($validated);

        if ($request->expectsJson()) {
            return response()->json($result);
        } else {
            return redirect('/')->with('order', $result);
        }
    }
}
