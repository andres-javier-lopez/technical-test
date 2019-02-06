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

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function insert(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        return response()->json([
            'status' => 'ok',
            'product_id' => $product->id,
            'link' => action('ProductController@show', ['product' => $product->id]),
        ]);
    }
}
