<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisa extends Model
{
    protected $guarded = ['id'];

    public function visaType()
    {
        return $this->belongsTo(CustomerVisaType::class, 'customer_visa_type_id', 'id');
    }
}
