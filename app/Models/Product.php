<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Uuid;

    protected $with = ['vendor'];

    protected $fillable = [
        'name', 'stock', 'company_id', 'description', 'code'
    ];

    protected $casts = [
        'id' => 'string',
        'code' => 'string',
        'name' => 'string',
        'stock' => 'integer',
        'company_id' => 'string',
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
