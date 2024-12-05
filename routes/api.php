<?php

use App\Http\Controllers\Api\PortofolioController;
use App\Http\Controllers\Api\LayananController;

Route::apiResource('/portofolios', PortofolioController::class);
Route::apiResource('/layanans', LayananController::class);
