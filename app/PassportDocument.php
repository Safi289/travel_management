<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassportDocument extends Model
{
    protected $guarded = ['id'];

    public function passport()
    {
        return $this->hasMany(CustomerPassport::class);
    }
}
