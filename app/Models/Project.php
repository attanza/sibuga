<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Uuid;

    protected $with = ['quotation.customer'];

    protected $fillable = [
        'quotation_id','code','title','start_date','end_date','status','terms','description','amount', 'with_ppn'
    ];

    protected $casts = [
        'id' => 'string',
        'quotation_id'=>'string',
        'code'=>'string',
        'title'=>'string',
        'start_date'=>'date',
        'end_date'=>'date',
        'status'=>'string',
        'terms'=>'string',
        'with_ppn'=>'boolean',
        'description'=>'string',
        'amount' =>  'decimal:2'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
