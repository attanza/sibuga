<?php

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();
        // $customers = Company::all();
        // foreach ($customers as $customer) {
        //     factory(Contact::class, 2)->create([
        //         'company_id' => $customer->id
        //     ]);
        // }
    }
}
