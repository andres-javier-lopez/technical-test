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

        return new ProductResource($product->fresh());
    }

    public function update(Request $request, Product $product)
    {
        if($request->has('name'))
        {
            $product->name = $request->input('name');
        }

        if($request->has('description'))
        {
            $product->description = $request->input('description');
        }

        if($request->has('price'))
        {
            $product->price = $request->input('price');
        }

        if($request->has('stock'))
        {
            $product->stock = $request->input('stock');
        }

        $product->save();

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
