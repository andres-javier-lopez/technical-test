<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Purchase;
use App\User;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductsResource;
use App\Http\Resources\Purchase as PurchaseResource;
use App\Events\PriceModified;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::withCount('likes');

        if($request->has('search'))
        {
            $search = $request->input('search');
            $query->where('name', 'like', "$search%");
        }

        switch($request->input('order'))
        {
            case 'popularity':
                $query->orderBy('likes_count', 'desc')->orderBy('name', 'asc');
                break;
            case 'name':
            default:
                $query->orderBy('name', 'asc');
        }

        $products = $query->paginate();
        return new ProductsResource($products);
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
            $old_price = $product->price;
            $product->price = $request->input('price');
            event(new PriceModified($product, $old_price));
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

    public function purchase(Request $request, Product $product)
    {
        $buyer = Auth::user();
        $quantity = (int) $request->input('quantity');

        if($quantity > $product->stock)
        {
            return response('Not enough product on stock', 500)->header('Content-Type', 'text/plain');
        }

        $purchase = new Purchase();
        $purchase->product_id = $product->id;
        $purchase->buyer_id = $buyer->id;
        $purchase->quantity = $quantity;
        $purchase->unit_price = $product->price;
        $purchase->total = $quantity*$product->price;
        $purchase->save();

        $product->stock = $product->stock - $quantity;
        $product->save();

        return new PurchaseResource($purchase->fresh());
    }
}
