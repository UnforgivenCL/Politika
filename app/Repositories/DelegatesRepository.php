<?php

namespace App\Repositories;

use App\Delegate;

class DelegatesRepository
{
    public static $regions = [
        'I de de Tarapacá' => '1',
        'II de de Antofagasta' => '2',
        'III de de Atacama' => '3',
        'IV de de Coquimbo' => '4',
        'V de de Valparaíso' => '5',
        "VI de del Libertador Bernardo O' Higgins" => '6',
        'VII de del Maule' => '7',
        'VIII de del Bío Bío' => '8',
        'IX de de la Araucanía' => '9',
        'X de de los Lagos' => '10',
        'XI de de Aysén del General Carlos Ibáñez del Campo' => '11',
        'XII de de Magallanes y de la Antártica Chilena' => '12',
        'RM de Metropolitana' => '13',
        'XIV de de los Ríos' => '14',
        'XV de Arica y Parinacota',
    ];

    public function updateDelegatesRegion()
    {
        $delegates = Delegate::all();

        foreach ($delegates as $delegate) {
            if (isset(self::$regions[$delegate->region])) {
                $delegate->region = self::$regions[$delegate->region];
                $delegate->save();
            }
        }
    }

    public function getDelegatesByRegion($regionId)
    {
        $delegates = Delegate::where('region', $regionId)->get();

        return $delegates;
    }
}
