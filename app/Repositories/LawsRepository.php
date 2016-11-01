<?php

namespace App\Repositories;

use App\Law;
use DB;
use ChileanLaw;
use App\Support\CongressApi\Exceptions\InternalServerErrorException;

class LawsRepository
{
    private static $excludedWords = [
        'de', 'El', 'la', 'Artículo', 'la',
        'en', 'y', 'Las', 'los', 'se', 'o',
        'con', 'comuna', 'el', 'que', 'las',
        'a', 'artículo', 'por', 'esta', 'un',
        'una', 'del', 'Créase', 'mediante', 'su',
        'no', ',', '",', 'lo', 'para', 'al', 'a)',
        'b)', 'c)', 'd)', 'e)', 'N°', 'Ley', 'siguiente',
        'ley', 'valores', 'Reemplázase', 'letra',
        'inciso', 'expresión', 'número', 'Modifícase',
        'numeral', 'punto', 'podrá', 'ser', 'y', 'como',
        '"y', 'refiere', 'entre', 'siguiente:', 'Intercálase',
        'sobre', 'agrégase', 'podrán', 'este', 'siguientes',
        'segundo', 'Agrégase', 'continuación', 'sea',
        'En', 'frase:',

    ];

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
        $key = 'latest-laws-paginate-'.$paginate;
        $laws = app('cache')->get($key);

        if ($laws === null) {
            $laws = ChileanLaw::law()->paginate($paginate)->getLatestPublished()->fetch();
            app('cache')->put($key, $laws, 60 * 24);
        }

        return $laws;
    }

    public function getLatestByBCN($bcnId)
    {
        try {
            $law = $this->find($bcnId);
            if ($law === null) {
                $law = ChileanLaw::law()->number($bcnId)->getLatestSpecific()->fetch();
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
            $laws = ChileanLaw::law()->paginate(5)->content($search)->getByContent()->fetch();

            return $laws;
        } catch (InternalServerErrorException $e) {
            return 'No existen leyes con tal contenido';
        }
    }

    public function getMostRepeatedWordOfLaw($law)
    {
        $topK = app('topkwords');

        if (isset($law['EstructurasFuncionales']['EstructuraFuncional'])) {
            foreach ($law['EstructurasFuncionales']['EstructuraFuncional'] as $content) {
                if (isset($content['Texto'])) {
                    foreach (explode(' ', $content['Texto']) as $word) {
                        $word = trim($word);
                        if (empty($word) || in_array($word, self::$excludedWords)) {
                            continue;
                        }

                        $topK->insertAWord($word);
                    }
                }
            }
        }

        return $topK->getTopKWords();
    }
}
