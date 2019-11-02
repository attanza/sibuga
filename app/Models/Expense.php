<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use Uuid;

    protected $with = ['project'];

    protected $fillable = [
        'project_id','item','amount', 'description'
    ];

    protected $casts = [
        'project_id'=>'string',
        'item'=>'string',
        'amount'=>'decimal:2',
        'description'=>'string',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
