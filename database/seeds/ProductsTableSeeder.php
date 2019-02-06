<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = 'New Awesome Product';
        $product->description = 'This product is awesome';
        $product->price = 9.99;
        $product->stock = 100;
        $product->save();
        $product->likes()->sync([1, 2]);

        $product = new Product();
        $product->name = 'Fantastic Product';
        $product->description = 'This product is fantastic';
        $product->price = 17.99;
        $product->stock = 50;
        $product->save();
        $product->likes()->sync([1]);

        $product = new Product();
        $product->name = 'Greatest Product';
        $product->description = 'This product is the greatest';
        $product->price = 19.99;
        $product->stock = 90;
        $product->save();

        $product = new Product();
        $product->name = 'Amazing Software';
        $product->description = 'This product is amazing';
        $product->price = 59.99;
        $product->stock = 10;
        $product->save();
    }
}
