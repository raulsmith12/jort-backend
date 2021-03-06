<?php

namespace App\Http\Controllers;

use App\Http\Resources\WinnerResource;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index ()
    {
        $winners = Winner::orderBy('id')->get();
        return WinnerResource::collection($winners);
    }

    public function show (Winner $winner)
    {
        return new WinnerResource($winner);
    }

    protected function validateRequest ()
    {
        return request()->validate([
            'product_id' => 'required',
            'user_id' => 'required'
        ]);
    }

    public function store ()
    {
        $data = $this->validateRequest();

        $winner = Winner::create($data);

        return new WinnerResource($winner);
    }

    public function update (Winner $winner)
    {
        $data = $this->validateRequest();

        $winner->update($data);

        return new WinnerResource($winner);
    }

    public function destroy (Winner $winner)
    {
        $winner->delete();

        return response()->noContent();
    }
}
