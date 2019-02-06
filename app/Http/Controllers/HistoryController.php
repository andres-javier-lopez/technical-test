<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceUpdate;
use App\Purchase;
use App\Http\Resources\PriceUpdate as PriceUpdateResource;
use App\Http\Resources\Purchase as PurchaseResource;

class HistoryController extends Controller
{
    public function purchaseHistory()
    {
        return PurchaseResource::collection(Purchase::orderBy('created_at', 'desc')->get());
    }

    public function priceHistory()
    {
        return PriceUpdateResource::collection(PriceUpdate::orderBy('created_at', 'desc')->get());
    }
}
