<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['package_type_title'];

    public function getPackageTypeTitleAttribute() {
        return $this->attributes['package_type_title'] = $this->package_type === 1 ? 'Hajj' : 'Omra Hajj';
    }

    public function hajj()
    {
        return $this->hasMany(Hajj::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
