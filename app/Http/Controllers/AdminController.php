<?php

namespace App\Http\Controllers;

use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('is-admin');

        return view('admin.index', [
            'usuarios' => User::where('tipo_usuario', '!=', 'admin')->paginate(2)
        ]);
    }
    public function create(Request $request)
    {
        Gate::authorize('is-admin');
        return app(\Laravel\Fortify\Http\Controllers\RegisteredUserController::class)->create($request);
    }
    public function store(Request $request)
    {
        Gate::authorize('is-admin');
        return app(\Laravel\Fortify\Http\Controllers\RegisteredUserController::class)->store($request, app(\App\Actions\Fortify\CreateNewUser::class));
    }
    public function delete(User $user)
    {
        Gate::authorize('is-admin');


        if ($user->isAdmin()) {
            return redirect()->back()->withErrors(['error' => 'Não é possível deletar um usuário administrador.']);
        } else {
            
        }

        $user->delete();

        return redirect()->back()->with('success', 'Usuário deletado com sucesso.');
    }


}
