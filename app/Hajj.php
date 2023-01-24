<?php

namespace App;

use App\ModelTraits\Hajj\HajjRelationshipsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Hajj extends Model
{
    use HajjRelationshipsTrait;

    protected $guarded = ['id'];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime:d-m-y',
        'end_date' => 'datetime:d-m-Y',
    ];

    protected $appends = ['departure_status_title', 'payment_status_title'];

    /*Accessors & Mutator Start*/
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = $value ? Carbon::parse($value)->format('d-m-Y') : $value;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = $value ? Carbon::parse($value)->format('d-m-Y') : $value;
    }

    public function getDepartureStatusTitleAttribute()
    {
        switch ($this->departure_status) {
            case 0:
                $data = 'None';
                break;
            case 1:
                $data = 'Flight Take Off';
                break;
            case 2:
                $data = 'Flight Arrived';
                break;
            case 3:
                $data = 'Staying';
                break;
            case 4:
                $data = 'Return Flight Take Off';
                break;
            case 5:
                $data = 'Return Flight Arrived';
                break;
            default:
                $data = null;
                break;
        }
        return $this->attributes['departure_status_title'] = $data;
    }

    public function getPaymentStatusTitleAttribute()
    {
        switch ($this->payment_status) {
            case 1:
                $data = 'Paid';
                break;
            default:
                $data = 'Partially Paid';
                break;
        }
        return $this->attributes['payment_status_title'] = $data;
    }

    public function getTypeValueAttribute()
    {
        return $this->attributes['type_value'] = ($this->type === 1) ? 'Hajj' : 'Omra Hajj';
    }

    /*Accessors & Mutator End*/

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(HajjPayment::class);
    }
}
