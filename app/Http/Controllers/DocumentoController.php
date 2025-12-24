<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentoRequest;
use App\Models\Documento;
use App\Models\Tcc;
use Gate;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Storage;
class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function index()
    {
        $user = Auth::user();
        if (Gate::allows('is-admin')) {
            //Ver todos os documentos, inclusive os deletados
            $documentos = Tcc::with([
                'documentos',
                'aluno' => function ($q) {
                    $q->withTrashed();

                },
                'orientador' => function ($q) {
                    $q->withTrashed();
                }
            ])->withTrashed()->paginate(2);
        } else {
            $documentos = $user->tccs()->with([
                'documentos',
                'aluno' => function ($q) {
                    $q->withTrashed();

                },
                'orientador' => function ($q) {
                    $q->withTrashed();
                }
            ])->paginate(2);
        }
        return view('documents.documentos', ['documentos' => $documentos]);
    }


    public function tipo(Tcc $tcc)
    {
        Gate::authorize('can-edit', $tcc);
        return view('documents.tipo', ['tcc' => $tcc]);
    }

    public function create(Tcc $tcc)
    {
        Gate::authorize('can-edit', ['tcc' => $tcc]);
        return view('documents.salvar', ['tcc' => $tcc, 'usuario' => Auth::user()]);
    }
    public function store(DocumentoRequest $request, Tcc $tcc)
    {
        $file = $request->file('file');
        $name = $file->hashName();
        $upload = Storage::put("documentos/", $file);
        Documento::create(
            [
                'hash' => "{$name}",
                'tipo' => $request['tipo'],
                'nome_arquivo' => $file->getClientOriginalName(),
                'url' => Storage::url("documentos/{$name}"),
                'autor_id' => $tcc->orientador->id,
                'tcc_id' => $tcc->id,

            ]
        );
        return redirect()->route('documentos.index');
    }


    public function baixar(Documento $documento)
    {
        //Autoriza à manipular o documento
        Gate::authorize('can-edit-document', $documento);
        //Retorna o arquivo;
        return Storage::download('documentos' . '/' . $documento->hash);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        //Autoriza à manipular o documento
        Gate::authorize('can-edit-document', $documento);
        Storage::delete('documentos/' . $documento->hash);
        //Deleta o documento com softDeletes
        $documento->delete();
        return redirect()->back();
    }
}
