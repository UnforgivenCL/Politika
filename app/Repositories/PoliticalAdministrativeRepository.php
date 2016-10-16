<?php

namespace App\Repositories;

use App\Commune;

class PoliticalAdministrativeRepository
{
    public function getCommunes()
    {
        return Commune::all();
    }

    public function getCommune($id)
    {
        return Commune::where('commune_id', $id)->first();
    }
}
