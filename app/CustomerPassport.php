<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPassport extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function passportStatuses()
    {
        return $this->belongsToMany(PassportStatus::class, 'passport_history', 'passport_id', 'passport_status_id')->withPivot('date')->withTimestamps();
    }

    public function passportCurrentStatus()
    {
        return $this->belongsToMany(PassportStatus::class, 'passport_history', 'passport_id', 'passport_status_id')
            ->orderBy('date', 'DESC')->limit(1);
    }

    public function reference()
    {
        return $this->belongsTo(Customer::class, 'reference_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(PassportDocument::class);
    }
}
