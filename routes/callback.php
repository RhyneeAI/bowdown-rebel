<?php

use App\Http\Controllers\CallbackController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans', [CallbackController::class, 'callbackMidtrans']);
