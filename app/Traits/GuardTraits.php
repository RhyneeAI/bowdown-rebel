<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait GuardTraits
{
    public function getGuardName()
    {
        $guardName = null;

        // Cek setiap guard yang terdaftar
        foreach (config('auth.guards') as $guard => $config) {
            if (Auth::guard($guard)->check()) {
                $guardName = $guard;
                break;
            }
        }

        return $guardName;
    }
}