<?php

namespace App\Models;

use App\Traits\Uuid;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use Uuid;

    protected $with = ['customer', 'creator'];

    protected $fillable = [
        'company_id','no','title','terms','description', 'created_by',
    ];

    protected $casts = [
        'id' => 'string',
        'company_id'=>'string',
        'created_by'=>'string',
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

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
