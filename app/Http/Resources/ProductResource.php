<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_id' => $this->product_id,
            'seller_id' => $this->seller_id,
            'short_desc' => $this->short_desc,
            'long_desc' => $this->long_desc,
            'category' => $this->category,
            'title' => $this->title,
            'creation_time' => $this->creation_time,
            'normal_timer' => $this->normal_timer,
            'quick_timer' => $this->quick_timer,
            'current_bid' => $this->current_bid,
            'increment' => $this->increment,
            'is_going_once' => $this->is_going_once,
            'is_going_twice' => $this->is_going_twice,
            'sold_timer' => $this->sold_timer,
            'is_sold' => $this->is_sold,
            'del_timer' => $this->del_timer
        ];
    }
}
