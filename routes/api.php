<?php

use App\Http\Controllers\DocumentoControllerApi;
use App\Http\Controllers\TccControllerApi;
use App\Http\Controllers\UserControllerApi;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/* Rotas do Tcc */
/*
    MODIFICAR PARA UTILIZAR RESOURCES,
    PARA MANTER A INTEGRIDADE DOS JSONS RETORNADOS

    UserResources
    TccResources
    DocResources

*/
Route::get("/tcc", [TccControllerApi::class, "index"])->name("tcc.api.index");
Route::get("/tcc/{id}", [TccControllerApi::class, "show"])->name("tcc.api.show");
Route::get("/docs-do-tcc/{id}", [TccControllerApi::class, "tcc_docs"])->name(
    "tcc.api.docs",
);
/* Rotas do Documento  */
Route::get("/documento", [DocumentoControllerApi::class, "index"])->name(
    "documento.api.index",
);
Route::get("/documento/{id}", [DocumentoControllerApi::class, "show"])->name(
    "documento.api.show",
);
Route::get("/debug-storage", function () {
    $disk = Storage::disk("local");

    return response()->json([
        "storage_path" => storage_path("app"),
        "existe_private" => $disk->exists("private"),
        "existe_private_documentos" => $disk->exists("private/documentos"),
        "todos_diretorios" => $disk->allDirectories(),
        "todos_arquivos" => $disk->allFiles(),
        "tentativas" => [
            "private/documentos" => $disk->exists("private/documentos"),
            "private" => $disk->exists("private"),
            "documentos" => $disk->exists("documentos"),
        ],
    ]);
});
/* Rotas dos users */
Route::get("/user", [UserControllerApi::class, "findUser"])->name("user.api.find");
