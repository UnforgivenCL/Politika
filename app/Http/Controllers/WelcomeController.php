<?php

namespace App\Http\Controllers;

use App\Repositories\LawsRepository;
use App\Repositories\PoliticalAdministrativeRepository;

class WelcomeController extends Controller
{
    protected $lawsRepo;
    protected $politicalRepo;

    public function __construct()
    {
        $this->lawsRepo = app(LawsRepository::class);
        $this->politicalRepo = app(PoliticalAdministrativeRepository::class);
    }

    public function index()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws(9);

        return view('welcome')
            ->with('laws', $lastLaws['NORMA']);
    }
}
