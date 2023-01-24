<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketingAirline extends Model
{
    protected $guarded = ['id'];

    private $statuses = [
        0 => 'Inactive',
        1 => 'Active'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->airlines_code = substr($model->airlines_code, 0, 2);
            $model->ticketing_serial = substr($model->ticketing_serial, 0, 3);
        });
    }

    public function getStatusTitleAttribute()
    {
        return $this->statuses[$this->status];
    }
}
