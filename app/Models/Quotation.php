<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use Uuid;

    protected $with = ['customer'];

    protected $fillable = [
        'company_id','no','title','terms','description',
    ];

    protected $casts = [
        'id' => 'string',
        'company_id'=>'string',
        'no'=>'string',
        'title'=>'string',
        'terms'=>'string',
        'description'=>'string',

    ];

    public function customer()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function products()
    {
        return $this->hasMany(QuotationProduct::class);
    }
}
