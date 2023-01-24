<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahramRelation extends Model
{
    protected $guarded = ['id'];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
