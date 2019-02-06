<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;
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

    public function like(Product $product, User $user)
    {
       $user->like($product);
        return response()->json(['status' => 'ok']);
    }

    public function unlike(Product $product, User $user)
    {
        $user->unlike($product);
        return response()->json(['status' => 'ok']);
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
