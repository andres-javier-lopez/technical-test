<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Purchase extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product' => $this->product->name,
            'buyer' => $this->buyer->name,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'total' => $this->total,
            'date' => $this->created_at->toDateTimeString(),
        ];
    }
}
