<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Uuid;

    protected $with = ['company'];

    protected $fillable = [
        'company_id', 'name', 'phone', 'email', 'gender','description'
    ];

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'gender' => 'string',
        'description' => 'string',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
