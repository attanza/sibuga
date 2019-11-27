<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id',
            'company_id',
            'code',
            'name',
            'stock',
            'weight',
            'buy_price',
            'sell_price',
            'lead_time',
            'is_publish',
            'description',
            'created_at',
            'updated_at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
}
