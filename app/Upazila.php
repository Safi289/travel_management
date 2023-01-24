<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $guarded = ['id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
