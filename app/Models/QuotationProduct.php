<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    use Uuid;

    protected $with = ['quotation', 'product'];

    protected $fillable = [
        'quotation_id','product_id','qty','price','note','picture'
    ];

    protected $casts = [
        'id'=>'string',
        'quotation_id'=>'string',
        'product_id'=>'string',
        'qty'=>'integer',
        'price'=>'decimal:2',
        'note'=>'string',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
