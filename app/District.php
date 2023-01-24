<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = ['id'];

    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }
}
