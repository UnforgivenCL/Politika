<?php

namespace App\Repositories;

class LawsRepository
{
    public function getLatestLaws()
    {
        $asd = app('congress')->law()->paginate(5)->getLatest();
        dd($asd->getUrl());
    }
}
