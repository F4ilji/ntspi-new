<?php

use App\Http\Controllers\api\NavigateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/getNavigation', NavigateController::class);



