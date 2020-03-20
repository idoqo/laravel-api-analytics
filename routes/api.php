<?php

use Illuminate\Support\Facades\Route;

Route::resource('recipes', 'Api\RecipesController')
    ->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('hit.save');
