<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchLawsRequest;
use App\Repositories\LawsRepository;

class WelcomeController extends Controller
{
    protected $lawsRepo;

    public function __construct()
    {
        $this->lawsRepo = app(LawsRepository::class);
    }

    public function index()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws();

        return view('welcome')
            ->with('laws', $lastLaws['NORMA']);
    }

    public function search(SearchLawsRequest $request)
    {
        $searchedLaws = $this->lawsRepo->getBySearch($request->srch_term);

        dd($searchedLaws);
    }
}
