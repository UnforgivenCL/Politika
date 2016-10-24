<?php

namespace App\Http\Controllers;

use App\Repositories\LawsRepository;

class HomeController extends Controller
{
    protected $lawsRepo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->lawsRepo = app(LawsRepository::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastLaws = $this->lawsRepo->getLatestLaws(3);
        //dd($lastLaws);

        return view('dashboard.home')
        ->with('laws', $lastLaws['NORMA']);
    }
}
