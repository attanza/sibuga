<?php

use App\Models\Company;
use App\Models\Quotation;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quotation::truncate();
        $customers = Company::where('category', 'Customer')->pluck('id');
        foreach ($customers as $customer) {
            factory(Quotation::class, 1)->create([
                'company_id' => $customer
            ]);
        }
    }
}
