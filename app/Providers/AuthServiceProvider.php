<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        // dd('aqui');
        $gate->define('auth', function($user, $role=NULL)
        {
          if($role === NULL)
          {
            $actions = Route::current()->getAction();
            dd($actions);
            if(isset($actions['role']))
            {
              $role = $actions['role'];
            }
            else
            {
              return false;
            }
          }
          return true;

        });
        //
    }
}
