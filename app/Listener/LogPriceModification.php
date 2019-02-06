<?php

namespace App\Listener;

use Illuminate\Support\Facades\Auth;
use App\Events\PriceModified;
use App\PriceUpdate;

class LogPriceModification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PriceModified  $event
     * @return void
     */
    public function handle(PriceModified $event)
    {
        if($event->old_price != $event->product->price)
        {
            $update = new PriceUpdate();
            $update->product_id = $event->product->id;
            $update->user_id = auth()->user()->id;
            $update->old_price = $event->old_price;
            $update->new_price = $event->product->price;
            $update->save();
        }
    }
}
