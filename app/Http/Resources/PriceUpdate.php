<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceUpdate extends JsonResource
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
            'modified_by' => $this->user->name,
            'original_price' => $this->old_price,
            'new_price' => $this->new_price,
            'date' => $this->created_at->toDateTimeString(),
        ];
    }
}
