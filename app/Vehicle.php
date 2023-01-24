<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = ['id'];

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
