<?php

namespace App;

class Delegate extends Model
{
    protected $collection = 'delegates';

    protected $fillable = [
        'nombre', 'region', 'distrito', 'partido',
    ];
}
