<?php

namespace App\Repositories;

class LawsRepository
{
    public function getLatestLaws()
    {
        $laws = app('congress')->law()->paginate(5)->getLatestPublished()->fetch();

        return $laws;
    }

    public function getBySearch($search)
    {
        $laws = app('congress')->law()->paginate(5)->content($search)->getByContent()->fetch();

        return $laws;
    }
}
