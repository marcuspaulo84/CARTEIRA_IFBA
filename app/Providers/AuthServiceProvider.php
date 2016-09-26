<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Permission;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth; // adicionado por Marcus

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
         User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        //
        if( !App::runningInConsole() ){
            $this->addPermission();
            foreach($this->getPermissions() as $permission) {
                $gate->define($permission->name, function($user) use($permission) {
                    return $user->hasRole($permission->roles) || $user->isAdmin();
                });
            }
        }

    }

    public function getPermissions()
    {
        return Permission::with('roles')->get();
    }

    public function addPermission(){
        if(Auth::check() && Auth::user()->get()->isEmpty()){
            Auth::user()->addRole("Servidor");
        }
    }


}
