<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'likes' => $this->when($this->likes_count, $this->likes_count, $this->likes()->count()),
            ],
            'link' => action('ProductController@show', ['product' => $this->id]),
        ];
    }
}
