<?php

use App\Http\Controllers\CallbackController;
use Illuminate\Support\Facades\Route;

Route::post('/callback/midtrans', [CallbackController::class, 'callbackMidtrans']);
