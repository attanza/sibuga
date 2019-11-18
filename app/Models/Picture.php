<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use Uuid;

    protected $fillable = ['caption', 'pictureable_id', 'url','pictureable_type', 'description', 'is_feature'];

    public function pictureable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute($value)
    {
        return asset(Storage::url($value));
    }
}
