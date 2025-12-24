<?php

namespace App\Http\Controllers;

use App\Models\Tcc;
use App\Models\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class TccController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        if (Gate::allows("is-admin")) {
            //Ver todos os documentos, inclusive os deletados
            $tccs = Tcc::with([
                "documentos",
                "aluno" => function ($q) {
                    $q->withTrashed();
                },
                "orientador" => function ($q) {
                    $q->withTrashed();
                },
            ])
                ->withTrashed()
                ->paginate(2);
        } else {
            $tccs = $user
                ->tccs()
                ->with([
                    "documentos",
                    "aluno" => function ($q) {
                        $q->withTrashed();
                    },
                    "orientador" => function ($q) {
                        $q->withTrashed();
                    },
                ])
                ->paginate(2);
        }
        return view("tcc.tccs", ["tccs" => $tccs]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize("can-create");
        return view("tcc.create");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Faço as verificações dos dados passados, que vai ser o documento de termo;
        $valid = $request->validate([
            "nome" => "max:100|required",
            "descricao" => "nullable|max:255",
            "matricula" => "required|exists:users,matricula",
            "data" => [
                "nullable",
                Rule::date()->afterOrEqual(today()->addYear()),
            ],
        ]);
        //Crio o tcc com os dados (Sem a necessidade de criar TODOS os documentos de uma vez)
        $aluno_id = User::where("matricula", $valid["matricula"])->first()->id;
        $usuario = Auth::user();
        $tcc = Tcc::create([
            "nome_projeto" => $valid["nome"],
            "descricao" => $valid["descricao"],
            "orientador_id" => $usuario->id,
            "aluno_id" => $aluno_id,
            "dia_defesa" => $valid["data"],
        ]);

        //Redireciono para o menu de criação do termo de aceite
        return redirect()->route("termo", [
            "usuario" => $usuario,
            "tcc" => $tcc,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tcc $tcc)
    {
        //Ele pode ver o tcc se ele tiver relacionado à ele
        Gate::authorize("see-tcc", $tcc);
        return view("tcc.show", ["tcc" => $tcc, "nome" => $tcc->aluno->name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tcc $tcc)
    {
        //Ele só edita se o tcc for dele e se não for um aluno
        Gate::authorize("can-edit", $tcc);
        $tcc_dinâmico = $tcc
            ::with([
                "aluno" => function ($q) {
                    $q->withTrashed();
                },
            ])
            ->get()
            ->first();
        return view("tcc.update", [
            "tcc" => $tcc,
            "nome" => $tcc_dinâmico->aluno->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tcc $tcc)
    {
        $valid = $request->validate([
            "nome" => ["max:100", "nullable"],
            "descricao" => ["nullable", "max:255"],
            "data" => [
                "nullable",
                Rule::date()->afterOrEqual(today()->addYear()),
            ],
        ]);
        $tcc->update([
            "nome_projeto" => $valid["nome"],
            "dia_defesa" => $valid["data"],
            "descricao" => $valid["descricao"],
        ]);
        return redirect()->route("tcc.edit", ["tcc" => $tcc]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tcc $tcc)
    {
        // Se ele pode editar
        Gate::authorize("can-edit", $tcc);
        $tcc->delete();
        return redirect()->route("tcc.index");
    }
}
