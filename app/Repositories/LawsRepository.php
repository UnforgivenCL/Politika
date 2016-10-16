<?php

namespace App\Repositories;

use App\Law;
use DB;
use App\Support\CongressApi\Exceptions\InternalServerErrorException;

class LawsRepository
{
    public function createLaw($input)
    {
        $_id = array_get($input['@attributes'], 'normaId');

        if (empty($input) || empty($_id)) {
            return;
        }

        $m = $this->find($_id);

        if ($m !== null) {
            return $m;
        }

        DB::collection('laws')->insert(['_id' => $_id, 'data' => $input]);
    }

    public function find($idNorm)
    {
        return Law::find($idNorm);
    }

    public function getLatestLaws($paginate)
    {
        $laws = app('congress')->law()->paginate($paginate)->getLatestPublished()->fetch();

        return $laws;
    }

    public function getLatestByBCN($bcnId)
    {
        try {
            $law = $this->find($bcnId);
            if ($law === null) {
                $law = app('congress')->law()->number($bcnId)->getLatestSpecific()->fetch();
                $this->createLaw($law);

                return $law;
            }

            return $law['data'];
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
