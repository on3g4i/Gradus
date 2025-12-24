<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\TccController;
use App\Models\Tcc;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('tcc', TccController::class);

    Route::controller(DocumentoController::class)->group(function () {
        Route::get('/documentos', 'index')->name('documentos.index');
        Route::post('/documentos/create/{tcc}', 'create')->name('documentos.create');
        Route::post('/documentos/{tcc}', 'store')->name('documentos.store');
        Route::get('/documentos/tipo/{tcc}', 'tipo')->name('tipos');
        Route::get('/documentos/upload/{tcc}', 'create')->name('salvar');
        Route::post('/documentos/upload/{tcc}', 'store')->name('upload');
        Route::get('/documentos/{documento}', 'baixar')->name('baixar');
        Route::delete('/documentos/{documento}', 'destroy')->name('documentos.delete');
    });

    // Vou melhorar isso aqui depois
    Route::get('/documentos/termo/{tcc}', function (Tcc $tcc) {
        Gate::authorize('can-edit', $tcc);
        return view('documents.termo', [
            'usuario' => Auth::user(),
            'tcc' => $tcc::with([
                'aluno' => function ($q) {
                    $q->withTrashed();
                },
                'orientador' => function ($q) {
                    $q->withTrashed();
                }
            ])->get()->first()
        ]);
    })->name('termo');

    Route::get('/documentos/banca/{tcc}', function (Tcc $tcc) {
        Gate::authorize('can-edit', $tcc);
        return view('documents.banca', ['usuario' => Auth::user(), 'tcc' => $tcc]);
    })->name('banca');

    Route::get('/documentos/defesa/{tcc}', function (Tcc $tcc) {
        Gate::authorize('can-edit', $tcc);
        return view('documents.defesa', ['usuario' => Auth::user(), 'tcc' => $tcc]);
    })->name('defesa');

    //O usuário admmin possue seu próprio controller para requisição de dados no web
    /*    Route::controller(AdminController::class)->group(
            function () {
                Route::get('/admin/usuarios', 'index')->name('admin.index');
                Route::get('/admin/register', 'create')->name('admin.create');
                Route::post('/admin/register', 'store')->name('admin.register');
                Route::delete('/admin/usuarios/{user}/delete', 'delete')->name('admin.delete');
            }
        );
 */

});
