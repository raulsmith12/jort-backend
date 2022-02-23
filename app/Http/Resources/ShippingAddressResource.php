<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'street' => $this->street,
            'apt' => $this->apt,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'is_primary' => $this->is_primary
        ];
    }
}
