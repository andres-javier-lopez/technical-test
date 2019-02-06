<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Http\Resources\Purchase as PurchaseResource;

class PurchaseController extends Controller
{
    public function index()
    {
        return PurchaseResource::collection(Purchase::all());
    }
}
