<?php

namespace App\Repositories;

use App\Support\CongressApi\Exceptions\InternalServerErrorException;

class LawsRepository
{
    public function getLatestLaws($paginate)
    {
        $laws = app('congress')->law()->paginate($paginate)->getLatestPublished()->fetch();

        return $laws;
    }

    public function getLatestByBCN($bcnId)
    {
        try {
            $law = app('congress')->law()->number($bcnId)->getLatestSpecific()->fetch();

            return $law;
        } catch (InternalServerErrorException $e) {
            return 'Error al obtener ley';
        }
    }

    public function getBySearch($search)
    {
        try {
            $laws = app('congress')->law()->paginate(5)->content($search)->getByContent()->fetch();

            return $laws;
        } catch (InternalServerErrorException $e) {
            return 'No existen leyes con tal contenido';
        }
    }
}
