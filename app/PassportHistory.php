<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassportHistory extends Model
{
    protected $table = 'passport_history';

    protected $guarded = ['id'];
}
