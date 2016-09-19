<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('sdb_login', function($attribute, $value, $parameters, $validator) {
            if($attribute == 'name') {
                return $value == env('sdb_name');
            } else if($attribute == 'psw') {
                return $value == env('sdb_pass');
            }
            return FALSE;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
