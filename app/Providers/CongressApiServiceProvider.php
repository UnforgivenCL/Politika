<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\CongressApi\ApiRequest;
use GuzzleHttp\Client;

class CongressApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('congress', function () {
            return new ApiRequest(new Client());
        });
    }
}
