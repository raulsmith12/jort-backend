<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index ()
    {
        $payment_methods = PaymentMethod::orderBy('id')->get();
        return PaymentMethodResource::collection($payment_methods);
    }

    public function show (PaymentMethod $payment_method)
    {
        return new PaymentMethodResource($payment_method);
    }

    protected function validateRequest ()
    {
        return request()->validate([
            'user_id' => 'required',
            'last4' => 'required'
        ]);
    }

    public function store ()
    {
        $data = $this->validateRequest();

        $payment_method = PaymentMethod::create($data);

        return new PaymentMethodResource($payment_method);
    }

    public function update (PaymentMethod $payment_method)
    {
        $data = $this->validateRequest();

        $payment_method->update($data);

        return new PaymentMethodResource($payment_method);
    }

    public function destroy (PaymentMethod $payment_method)
    {
        $payment_method->delete();

        return response()->noContent();
    }
}
