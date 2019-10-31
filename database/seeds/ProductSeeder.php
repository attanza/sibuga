<?php

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        // $vendors = Company::where('category', 'Vendor')->pluck('id');
        // foreach ($vendors as $vendor) {
        //     factory(Product::class, 2)->create([
        //         'company_id' => $vendor
        //     ]);
        // }
    }
}
