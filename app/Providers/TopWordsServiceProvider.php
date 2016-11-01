<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\TopWordsAlgorithm\TopKWordsStat;

class TopWordsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('topkwords', function () {
            return new TopKWordsStat(15);
        });
    }
}
