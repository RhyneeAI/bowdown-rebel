<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        
        view()->composer('*', function ($view) {
            $role = null;
            $guard = null;
            $checkGuard = ['Admin', 'User'];
            foreach ($checkGuard as $guard) {
                $authCheck = Auth::guard($guard)->check();

                if ($authCheck) {
                    $role = Auth::guard($guard)->user()->role->role;
                    $guard = $guard;
                    break;
                } 
            }
            
            $view->with(['role' => $role, 'guard' => $guard]);
        });
    }
}
