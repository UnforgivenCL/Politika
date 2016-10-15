<?php

namespace App\Repositories;

class LawsRepository
{
    public function getLatestLaws()
    {
        $asd = app('congress')->law()->paginate(5)->content('campesinos')->getByContent()->fetch();
        dd($asd);
    }
}
