<?php

namespace App;

class Province extends Model
{
    protected $primaryKey = 'province_id';

    protected $fillable = [
        'name', 'region_id',
    ];

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function communes()
    {
        return $this->hasMany('App\Commune');
    }
}
