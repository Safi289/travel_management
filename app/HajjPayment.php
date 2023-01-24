<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HajjPayment extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['type_value'];

    /*Accessors & Mutator Start*/
    public function setDepositDateAttribute($value)
    {
        $this->attributes['deposit_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDepositDateAttribute($value)
    {
        return $this->attributes['deposit_date'] = $value ? Carbon::parse($value)->format('d-m-Y') : $value;
    }

    public function getTypeValueAttribute()
    {
        return $this->attributes['type_value'] = ($this->type === 1) ? 'Cash' : 'Bank/Cheque';
    }

    /*Accessors & Mutator End*/

    public function hajj()
    {
        return $this->belongsTo(Hajj::class);
    }
}
