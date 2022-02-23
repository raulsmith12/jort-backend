<?php

namespace App\Http\Controllers;

use App\Http\Resources\BidResource;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index ()
    {
        $bids = Bid::orderBy('id')->get();
        return BidResource::collection($bids);
    }

    public function show (Bid $bid)
    {
        return new BidResource($bid);
    }

    protected function validateRequest ()
    {
        return request()->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'bid_amount' => 'required',
            'bid_time' => 'required'
        ]);
    }

    public function store ()
    {
        $data = $this->validateRequest();

        $bid = Bid::create($data);

        return new BidResource($bid);
    }

    public function update (Bid $bid)
    {
        $data = $this->validateRequest();

        $bid->update($data);

        return new BidResource($bid);
    }

    public function destroy (Bid $bid)
    {
        $bid->delete();

        return response()->noContent();
    }
}
