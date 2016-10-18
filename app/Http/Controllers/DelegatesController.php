<?php

namespace App\Http\Controllers;

use App\Repositories\DelegatesRepository;

class DelegatesController extends Controller
{
    protected $delegatesRepo;

    public function __construct()
    {
        $this->delegatesRepo = app(DelegatesRepository::class);
    }

    public function getDelegatesByPoliticalGroups()
    {
        return $this->delegatesRepo->getCountDelegatesByPoliticalGroup();
    }
}
