<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Uuid;

    protected $with = ['company'];

    protected $fillable = [
        'company_id','code','title','start_date','end_date','status','terms','description','amount'
    ];

    protected $casts = [
        'id' => 'string',
        'company_id'=>'string',
        'code'=>'string',
        'title'=>'string',
        'start_date'=>'date',
        'end_date'=>'date',
        'status'=>'string',
        'terms'=>'string',
        'description'=>'string',
        'amount' =>  'decimal:2'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
