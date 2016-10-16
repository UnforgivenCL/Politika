<?php

namespace App;

class Commune extends Model
{
    protected $collection = 'communes';
    protected $primaryKey = 'commune_id';

    protected $fillable = [
        'name', 'commune_id',
    ];

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
