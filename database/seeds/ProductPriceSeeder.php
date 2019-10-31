<?php

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPrice::truncate();
        // $products = Product::all();
        // foreach ($products as $product) {
        //     factory(ProductPrice::class, 2)->create([
        //         'product_id' => $product->id
        //     ]);
        // }
    }
}
