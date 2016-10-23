<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateDelegatesWithPoliticalGroupJob;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function updateDelegates()
    {
        dispatch(new UpdateDelegatesWithPoliticalGroupJob());

        return view('admin.index');
    }
}
