<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = ['voucher_name', 'type', 'depositor_name', 'bank_name', 'bank_branch_name', 'cheque_number',  'deposit_date', 'amount', 'status'];

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
