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

    public function searchByBCN($bcnId)
    {
        $law = $this->lawsRepo->getLatestByBCN($bcnId);
        //dd($law);
        return view('laws.law')
            ->with('law', $law);
    }

    public function search(SearchLawsRequest $request)
    {
        $searchedLaws = $this->lawsRepo->getBySearch($request->srch_term);

        dd($searchedLaws);
    }
}
