<?php

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();
        // $customers = Company::where('category', 'Customer')->pluck('id');
        // foreach ($customers as $customer) {
        //     factory(Project::class, 1)->create([
        //         'company_id' => $customer
        //     ]);
        // }
    }
}
