<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShippingAddressResource;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function index ()
    {
        $shipping_addresses = ShippingAddress::orderBy('id')->get();
        return ShippingAddressResource::collection($shipping_addresses);
    }

    public function show (ShippingAddress $shipping_address)
    {
        return new ShippingAddressResource($shipping_address);
    }

    protected function validateRequest ()
    {
        return request()->validate([
            'user_id' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required|min:2',
            'postal_code' => 'required|min:5',
            'is_primary' => 'required'
        ]);
    }

    public function store ()
    {
        $data = $this->validateRequest();

        $shipping_address = ShippingAddress::create($data);

        return new ShippingAddressResource($shipping_address);
    }

    public function update (ShippingAddress $shipping_address)
    {
        $data = $this->validateRequest();

        $shipping_address->update($data);

        return new ShippingAddressResource($shipping_address);
    }

    public function destroy (ShippingAddress $shipping_address)
    {
        $shipping_address->delete();

        return response()->noContent();
    }
}
