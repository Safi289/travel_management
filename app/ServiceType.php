<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = ['id'];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
