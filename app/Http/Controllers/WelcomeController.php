<?php

namespace App\Http\Controllers;

use App\Repositories\LawsRepository;

class WelcomeController extends Controller
{
    protected $lawsRepo;
    protected $delegatesRepo;

    public function __construct()
    {
        $this->lawsRepo = app(LawsRepository::class);
    }

    public function index()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws(9);

        return view('welcome')
            ->with('laws', $lastLaws['NORMA']);
    }
}
