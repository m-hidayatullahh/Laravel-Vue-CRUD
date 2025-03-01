<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;

Route::apiResource('warga', WargaController::class);
