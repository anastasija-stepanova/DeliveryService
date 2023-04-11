<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shipping\ShippingRequest;
use App\Services\Shipping\ShippingService;
use ErrorException;
use Illuminate\Http\RedirectResponse;

class ShippingController extends Controller
{
    /**
     * @param ShippingRequest $request
     * @return RedirectResponse
     * @throws ErrorException
     */
    public function shipping(ShippingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $result = ShippingService::makeShipping($validated);

        return redirect('/')->with('order', $result);
    }
}
