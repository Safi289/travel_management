<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'country_id';

    protected $fillable = [
        'country_name', 'country_desc'
    ];

    
}
