<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisaType extends Model
{
    protected $guarded = ['id'];

    public function customerVisas()
    {
        return $this->hasMany(CustomerVisa::class);
    }
}
