<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use App\Models\Tcc;
use App\Models\User;
use Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;
class TccControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dataWordCloud()
    {
        $tccs = Tcc::all();

        #Pego os textos de todos os tccs
        $texto = strtolower($tccs->pluck('descricao')->implode(' '));

        #Retiro pontuacoes e quebra de linhas
        $texto = preg_replace('/[^\p{L}\p{N}\s]/u', '', $texto);

        $palavras = explode(' ', $texto);

        #Palavras desnecessarias para o texto, e que irao me atrapalhar na busca
        $palavrasDesnecessarias = ['de', 'da', 'do', 'a', 'o', 'em', 'para', 'com', 'que', 'e'];

        #Filtrando as palavras desnecessarias
        $palavras = array_filter($palavras, fn($p) =>
            !in_array($p, $palavrasDesnecessarias) && strlen($p) > 3);

        #Pego a frequencia de cada palavra
        $frequencia = array_count_values($palavras);
        arsort($frequencia);

        #pego somente as 20 primeiras, pra dar o suficiente para o chart
        $data = array_slice($frequencia, 0, 20, true);

        return response()->json($data);
    }

    public function index()
    {
        $tccs = Tcc::all();
        return response()->json([
            "message" => "Tccs pegos com sucesso",
            "response" => $tccs,
            "errors" => []
        ], 200);
    }

    public function tcc_docs($id)
    {
        $tcc = Tcc::find($id);
        $docs = $tcc->documentos()->get();
        if (isEmpty($docs)) {
            return response()->json([
                "message" => "Docs do tcc pego com sucesso",
                "response" => $docs,
                "errors" => []
            ]);
        } else {
            return response()->json([
                "message" => "Nenhum documento associado ao TCC",
                "response" => [],
                "errors" => []
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */

    // Deixando, pois talvez use
    public function create()
    {
        Gate::authorize('can-create');
        return view('tcc.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //Deixando pois talvez use
    public function store(Request $request)
    {
        //Fazer um request personalizado para os TCC'sP
        //Faço as verificações dos dados passados, que vai ser o documento de termo;
        DB::beginTransaction();

        $valid = $request->validate([
            'nome' => 'max:100|required',
            'descricao' => 'nullable|max:255',
            'matricula' => 'required|exists:users,matricula',
            'data' => [
                'nullable',
                Rule::date()->after(today()),
            ]


        ]);
        //Crio o tcc com os dados (Sem a necessidade de criar TODOS os documentos de uma vez)
        $aluno_id = User::where('matricula', $valid['matricula'])->first()->id;

        $tcc = Tcc::create(
            [
                'nome_projeto' => $valid['nome'],
                'descricao' => $valid['descricao'],
                'orientador_id' => Auth::user()->id,
                'aluno_id' => $aluno_id,
                'dia_defesa' => $valid['data']
            ]
        );
        DB::commit();

        //Redireciono para o menu de criação do termo
        return redirect()->route('documento.termo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tcc $tcc)
    {
        //Por mais que haja uma gate, to garantindo que vou mandar alguma coisa com o móvel
        try {
            $objectTcc = Tcc::find($tcc->id);
            //Ele pode ver o tcc se ele tiver relacionado à ele
            Gate::authorize('see-tcc', $objectTcc);
            return response()->json([
                'message' => "Tcc encontrado com sucesso",
                'response' => $objectTcc,
                'errors' => []
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Houve um erro na busca",
                'response' => [],
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    // Acho que essa é desnecessária
    // public function edit(Tcc $tcc)
    // {
    //     //Ele só edita se o tcc for dele e se não for um aluno
    //     Gate::authorize('can-edit', $tcc);
    //     return view('tcc.update', ['tcc' => $tcc, 'nome' => $tcc->aluno->name]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tcc $tcc)
    {
        $valid = $request->validate([
            'nome' => 'max:100|nullable',
            'descricao' => 'nullable|max:255',
        ]);
        $tcc->update($valid);
        return view('tcc.show', ['tcc' => $tcc, 'nome' => $tcc->aluno->name]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tcc $tcc)
    {
        // Se ele pode editar
        Gate::authorize('can-edit', $tcc);
        //O aluno não pode apagar o tcc do sistema
        if (!Gate::allows('is-aluno')) {
            $tcc->delete();
            
        } 
        
        return redirect()->route('tcc.index');

    }
}

