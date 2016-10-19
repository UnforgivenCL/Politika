<?php

namespace App\Http\Controllers;

use App\Repositories\LawsRepository;
use App\Repositories\DelegatesRepository;

class WelcomeController extends Controller
{
    protected $lawsRepo;
    protected $delegatesRepo;

    public function __construct()
    {
        $this->lawsRepo = app(LawsRepository::class);
        $this->delegatesRepo = app(DelegatesRepository::class);
    }

    public function index()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws(3);
        dd(app('congress')->session()->number(319)->getSessions()->fetch());

        return view('welcome')
            ->with('laws', $lastLaws['NORMA']);
    }
}
