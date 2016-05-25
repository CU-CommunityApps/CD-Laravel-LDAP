<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ActiveDirectory;

class LDAPServiceProvider extends ServiceProvider
{
    protected $defer=true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\LDAPContract', function() {
            return new LDAP();
        });
    }

    public function provides()
    {
        return ['App\Helpers\Contracts\LDAPContract'];
    }
}
