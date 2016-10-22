<?php

Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);
