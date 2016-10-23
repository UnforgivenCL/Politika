<?php

Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);
Route::get('jobs/update_delegates', ['uses' => 'DashboardController@updateDelegates', 'as' => 'admin.job.update-delegates']);
