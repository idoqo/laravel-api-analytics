<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('recipes', 'Api\RecipesController')
    ->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('hits', 'Api\HitsController')
    ->only(['index']);
