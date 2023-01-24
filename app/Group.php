<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id'];

    public function getManagementTypeValueAttribute($value)
    {
        return $value == 0 ? 'Public' : 'Private';
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
