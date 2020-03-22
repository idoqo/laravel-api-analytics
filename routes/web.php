<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/{any}', 'DashboardController@showDashboard');
