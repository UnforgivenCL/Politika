<?php

namespace App\Http\Controllers;

use App\Repositories\LawsRepository;
use App\Repositories\DelegatesRepository;
use App\Repositories\SenatorsRepository;

class WelcomeController extends Controller
{
    protected $lawsRepo;
    protected $delegatesRepo;
    protected $senatorsRepo;

    public function __construct()
    {
        $this->middleware('guest');
        $this->lawsRepo = app(LawsRepository::class);
        $this->delegatesRepo = app(DelegatesRepository::class);
        $this->senatorsRepo = app(SenatorsRepository::class);
    }

    public function index()
    {
        //dd($this->senatorsRepo->getVotationsOfSessionById('7667'));
        $chart = $this->delegatesRepo->getChartWithDelegates();
        $lastLaws = $this->lawsRepo->getLatestLaws(3);

        return view('welcome')
            ->with('laws', $lastLaws['NORMA'])
            ->with('chart', $chart);
    }
}
