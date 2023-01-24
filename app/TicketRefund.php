<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketRefund extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'refund_date'
    ];

    public function getRefundDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function ticketSale()
    {
        return $this->belongsTo(TicketSale::class, 'ticket_sale_id', 'id');
    }

    public function refundUser()
    {
        return $this->belongsTo(Customer::class, 'refund_user_id', 'id');
    }
}
