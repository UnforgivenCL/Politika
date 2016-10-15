<?php

namespace App\Repositories;

class LawsRepository
{
    public function getLatestLaws()
    {
        $asd = app('congress')->law()->getMostSearched()->fetch();
        dd($asd);
    }
}
