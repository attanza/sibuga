<?php

use App\Models\QuotationProduct;
use Illuminate\Database\Seeder;

class QuotationProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuotationProduct::truncate();
    }
}
