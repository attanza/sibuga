<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use Uuid;

    protected $with = ['product'];

    protected $fillable = [
        'product_id', 'qty', 'price', 'lead_time',
    ];

    protected $casts = [
        'id' => 'string',
        'product_id' => 'string',
        'qty' => 'integer',
        'price' => 'decimal:2',
        'lead_time' => 'integer',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
