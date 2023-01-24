<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassportStatus extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderBySerialNo', function ($builder) {
            $builder->orderBy('serial_no', 'asc');
        });
    }

    public function passports()
    {
        return $this->belongsToMany(PassportStatus::class, 'passport_history', 'passport_status_id', 'passport_id')->withPivot('date')->withTimestamps();
    }
}
