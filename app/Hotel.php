<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $guarded = ['id'];

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
