<?php

namespace App;

class Delegate extends Model
{
    protected $collection = 'diputados';

    protected $fillable = [
        'nombre', 'region', 'distrito', 'partido',
    ];
}
