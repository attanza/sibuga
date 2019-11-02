<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Uuid;

    protected $with = ['quotation.customer'];

    protected $fillable = [
        'quotation_id','code','title','start_date','end_date','status','terms','description','amount'
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
        'description'=>'string',
        'amount' =>  'decimal:2'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
