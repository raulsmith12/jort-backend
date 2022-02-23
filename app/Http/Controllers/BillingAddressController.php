<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillingAddressResource;
use App\Models\BillingAddress;
use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    public function index ()
    {
        $billing_addresses = BillingAddress::orderBy('id')->get();
        return BillingAddressResource::collection($billing_addresses);
    }

    public function show (BillingAddress $billing_address)
    {
        return new BillingAddressResource($billing_address);
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

        $billing_address = BillingAddress::create($data);

        return new BillingAddressResource($billing_address);
    }

    public function update (BillingAddress $billing_address)
    {
        $data = $this->validateRequest();

        $billing_address->update($data);

        return new BillingAddressResource($billing_address);
    }

    public function destroy (BillingAddress $billing_address)
    {
        $billing_address->delete();

        return response()->noContent();
    }
}
