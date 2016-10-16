<?php

namespace App\Repositories;

use App\PoliticalGroup;

class PoliticalGroupsRepository
{
    public static $politicalGroups = [
        'Izquierda Ciudadana' => '1',
        'Partido Socialista' => '2',
        'Unión Demócrata Independiente' => '3',
        'Partido Demócrata Cristiano' => '4',
        'Partido Por la Democracia' => '5',
        'Renovación Nacional' => '6',
        'Independientes' => '7',
        'Amplitud' => '8',
        'Partido Comunista' => '9',
        'Partido Radical Social Demócrata' => '10',
        'Evopolis' => '11',
        'Partido Liberal de Chile' => '12',
    ];

    /**
     * Use for initializate the political groups of Chile.
     */
    public function createPoliticalGroups()
    {
        foreach (self::$politicalGroups as $name => $politicalGroupId) {
            $politicalGroup = new PoliticalGroup();
            $politicalGroup->_id = $politicalGroupId;
            $politicalGroup->name = $name;
            $politicalGroup->save();
        }
    }
}
