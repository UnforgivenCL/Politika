<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchLawsRequest;
use App\Repositories\LawsRepository;

class LawsController extends Controller
{
    protected $lawsRepo;

    public function __construct()
    {
        $this->lawsRepo = app(LawsRepository::class);
    }

    public function getLatest()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws(9);

        return $lastLaws;
    }

    public function searchByBCN($bcnId)
    {
        $law = $this->lawsRepo->getLatestByBCN($bcnId);

        return view('laws.law')
            ->with('law', $law['data'])
            ->with('words', $law['frequent']);
    }

    public function search(SearchLawsRequest $request)
    {
        $searchedLaws = $this->lawsRepo->getBySearch($request->srch_term);

        dd($searchedLaws);
    }
}
