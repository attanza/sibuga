<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Uuid;

    protected $fillable = ['name', 'phone', 'email', 'category', 'address', 'description'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
