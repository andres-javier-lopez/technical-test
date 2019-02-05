<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductsResource;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductsResource(Product::withCount('likes')->paginate());
    }
}
