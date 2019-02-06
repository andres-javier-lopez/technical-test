<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Product;

class PriceModified
{
    use SerializesModels;

    public $product;

    public $old_price;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product, $old_price)
    {
        $this->product = $product;
        $this->old_price = $old_price;
    }
}
