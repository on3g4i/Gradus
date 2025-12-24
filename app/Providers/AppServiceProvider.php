<?php

namespace App\Providers;


use App\Models\Documento;
use App\Models\Tcc;
use App\Models\User;
use Auth;
use Gate;
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
        Gate::define('see-tcc', function (User $user, Tcc $tcc) {
            if ($user->isAdmin()) {
                return true;
            }
            switch ($user->tipo_usuario) {
                case 'aluno':
                    return $tcc->aluno->is($user);
                case 'orientador':
                    return $tcc->orientador->is($user);
                default:
                    return false;
            }
        });
        //Acho que eu posso fazer uma interceptação com middleware //Vou fazer isso :> ?
        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin();
        });
        Gate::define('is-aluno', function (User $user) {
            return $user->isAluno();
        });
        Gate::define('is-orientador', function (User $user) {
            return $user->isOrientador();
        });
        Gate::define('can-edit', function (User $user, Tcc $tcc) {
            Gate::authorize('see-tcc', $tcc);
            return (!$user->isAluno());

        });
        Gate::define('can-create', function (User $user) {
            if (!$user->isAluno()) {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('can-edit-document', function (User $user, Documento $documento) {
            if ($user->isAluno()) {
                return false;
            } else {
                if ($user->isAdmin()) {
                    return true;
                } else {
                    return $documento->autor->is($user);
                }
            }

        });




    }
}
