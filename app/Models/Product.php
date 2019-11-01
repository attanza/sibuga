<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Uuid;

    protected $with = ['vendor'];

    protected $fillable = [
        'name', 'stock', 'company_id', 'description', 'code', 'weight', 'buy_price', 'sell_price', 'lead_time'
    ];

    protected $casts = [
        'id' => 'string',
        'code' => 'string',
        'name' => 'string',
        'stock' => 'integer',
        'company_id' => 'string',
        'weight' => 'float',
        'lead_time' => 'integer',
        'buy_price' => 'decimal:2',
        'sell_price' => 'decimal:2',
        'description' => 'string',

    ];

    public function vendor()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function pictures()
    {
        return $this->morphMany('App\Models\Picture', 'pictureable');
    }
}
