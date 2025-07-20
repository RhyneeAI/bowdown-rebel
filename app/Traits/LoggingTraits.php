<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait LoggingTraits
{
    public function logMidtransError($error)
    {
        Log::channel('midtrans_error')->error($error);
    }
}