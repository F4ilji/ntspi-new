<?php

use App\Http\Controllers\api\NavigateController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/getNavigation', [NavigateController::class, 'index'])->name('client.main.navigate');

Route::get('/search', [SearchController::class, 'index'])->name('client.search.index');

