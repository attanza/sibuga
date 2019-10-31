<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();
        DB::table('pictures')->truncate();
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductPriceSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(QuotationSeeder::class);
        $this->call(QuotationProductSeeder::class);
    }
}
