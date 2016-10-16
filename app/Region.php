<?php

namespace App;

class Region extends Model
{
    protected $primaryKey = 'region_id';

    protected $fillable = [
        'name', 'region_id',
    ];

    public function provinces()
    {
        return $this->hasMany('App\Province');
    }
}
