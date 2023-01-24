<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketSale extends Model
{
    protected $guarded = ['id'];

    public function airline()
    {
        return $this->belongsTo(TicketingAirline::class, 'ticketing_airline_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sales_by', 'id');
    }
}
