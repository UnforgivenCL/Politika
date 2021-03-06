<?php

namespace App\Repositories;

use App\Delegate;
use App\PoliticalGroup;
use DB;
use Charts;

class DelegatesRepository
{
    protected $db;

    public static $regions = [
        'I de de Tarapacá' => 1,
        'II de de Antofagasta' => 2,
        'III de de Atacama' => 3,
        'IV de de Coquimbo' => 4,
        'V de de Valparaíso' => 5,
        "VI de del Libertador Bernardo O' Higgins" => 6,
        'VII de del Maule' => 7,
        'VIII de del Bío Bío' => 8,
        'IX de de la Araucanía' => 9,
        'X de de los Lagos' => 10,
        'XI de de Aysén del General Carlos Ibáñez del Campo' => 11,
        'XII de de Magallanes y de la Antártica Chilena' => 12,
        'RM de Metropolitana' => 13,
        'XIV de de los Ríos' => 14,
        'XV de Arica y Parinacota' => 15,
    ];

    public static $politicalGroups = [
        'Izquierda Ciudadana' => 1,
        'Partido Socialista' => 2,
        'Unión Demócrata Independiente' => 3,
        'Partido Demócrata Cristiano' => 4,
        'Partido Por la Democracia' => 5,
        'Renovación Nacional' => 6,
        'Independientes' => 7,
        'Amplitud' => 8,
        'Partido Comunista' => 9,
        'Partido Radical Social Demócrata' => 10,
        'Evopolis' => 11,
        'Partido Liberal de Chile' => 12,
        'Revolución Democrática' => 13,
    ];

    public static $politicalGroupsAlias = [
        'Izquierda Ciudadana' => 'IC',
        'Partido Socialista' => 'PS',
        'Unión Demócrata Independiente' => 'UDI',
        'Partido Demócrata Cristiano' => 'PDC',
        'Partido Por la Democracia' => 'PPD',
        'Renovación Nacional' => 'RN',
        'Independientes' => 'Indep.',
        'Amplitud' => 'Ampl.',
        'Partido Comunista' => 'PC',
        'Partido Radical Social Demócrata' => 'PRSC',
        'Evopolis' => 'Evop.',
        'Partido Liberal de Chile' => 'PLC',
        'Revolución Democrática' => 'RD',
    ];

    public function __construct()
    {
        $this->db = DB::getMongoDB();
    }

    public function findById($id)
    {
        return Delegate::where('_id', $id)->get()->first();
    }

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

    public function updateDelegatesPoliticalGroup()
    {
        $delegates = Delegate::all();
        foreach ($delegates as $delegate) {
            if (isset(self::$politicalGroups[$delegate->data['Militancia_Actual']['Partido']])) {
                $delegate['partido'] = self::$politicalGroups[$delegate->data['Militancia_Actual']['Partido']];
                $delegate->save();
            }
        }
    }

    public function getDelegatesByRegion($regionId)
    {
        $delegates = Delegate::where('region', $regionId)->get();

        return $delegates;
    }

    public function getDelegatesByPoliticalGroup($politicalGroupId)
    {
        $delegates = Delegate::where('partido', $politicalGroupId)->get();

        return $delegates;
    }

    public function getChartWithDelegates()
    {
        $delegatesData = $this->getCountDelegatesByPoliticalGroup();

        $politicalGroups = PoliticalGroup::all();

        foreach ($politicalGroups as $group) {
            $delegatesData[0][$group->_id]['nombrePartido'] = self::$politicalGroupsAlias[$group->name];
        }

        $politicalNames = array_column($delegatesData[0], 'nombrePartido');
        $politicalGroupValues = array_column($delegatesData[0], 'totalDelegates');

        $chart = Charts::create('pie', 'highcharts')
            ->setTitle('Cámara de Diputados')
            ->setLabels($politicalNames)
            ->setValues($politicalGroupValues)
            ->setDimensions(400, 400)
            ->setResponsive(true);

        return $chart;
    }

    public function getCountDelegatesByPoliticalGroup()
    {
        $total = $this->getTotalDelegatesByPoliticalGroup();

        $subs[] = $this->map($total, function ($i) {
            return [
                'idPoliticalGroup' => $i->_id,
                'totalDelegates' => $i->total,
            ];
        });

        return $subs;
    }

    protected function getTotalDelegatesBySpecificPoliticalGroup($politicalGroup)
    {
        return $this->db->delegates->aggregate([
            ['$match' => [
                    'partido' => $politicalGroup,
                ],
            ],
            ['$project' => [
                    'partido' => 1,
                ],
            ],
            ['$group' => [
                    '_id' => '$partido',
                    'total' => ['$sum' => 1],
                ],
            ],
        ])->toArray();
    }

    protected function getTotalDelegatesByPoliticalGroup()
    {
        return $this->db->delegates->aggregate([
            ['$project' => [
                    'partido' => 1,
                ],
            ],
            ['$group' => [
                    '_id' => '$partido',
                    'total' => ['$sum' => 1],
                ],
            ],
        ])->toArray();
    }

    protected function map($result, $fn = null)
    {
        $d = [];
        foreach ($result as $i) {
            $d[$i['_id']] = $fn !== null ? $fn($i) : $i;
        }

        return $d;
    }
}
