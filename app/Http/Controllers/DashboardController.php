<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Tcc;
use Illuminate\Database\Eloquent\Collection;
use Auth;
use Gate;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $user = Auth::user();
        $today = now()->toDateString();
        //Pega todos os tccs do usuário, no caso se ele for orientador, verifica se a data é maior que a data do dia e organiza por dias da defesa
        if ($user->isOrientador()) {
            $tccs = $user->tccs()->where('tcc.dia_defesa', '>', $today)->orderBy('tcc.dia_defesa')->get();


            return view('dashboard', [
                'tccs' => $tccs,
                'dashboard' => new Dashboard(),
                'palavraChave' => $this->dataWordCloud($tccs),
                'qntdDeTccPorMes' => $this->quantidadeDeTccPorMes($tccs),
            ]);
        } elseif ($user->isAluno()) {

            return view('dashboard', [
                'tcc' => $user->tccs(),
            ]);
        } else {
            $tccs = Tcc::all();
            return view('dashboard', [
                'tccs'=>$tccs,
                'dashboard' => new Dashboard(),
                'palavraChave' => $this->dataWordCloud($tccs),
                'qntdDeTccPorMes' => $this->quantidadeDeTccPorMes($tccs),
            ]);
        }
    }

    private function quantidadeDeTccPorMes(Collection $tccs): array
    {
        #Array que terá os dados, mês => qntdDeTcc
        $quantidadePorMes = array_fill(1, 12, 0);

        if (is_null($tccs))
            return [];


        foreach ($tccs as $t) {
            if (empty($t->dia_defesa))
                continue;

            $mes = explode('-', $t->dia_defesa);
            $quantidadePorMes[(int) $mes[1]] += 1;
        }

        return $quantidadePorMes;
    }

    #Pega as palavras-chave dos tccs
    private function dataWordCloud(Collection $tccs)
    {
        #Pego os textos de todos os tccs
        $texto = strtolower($tccs->pluck('descricao')->implode(' '));

        #Retiro pontuacoes e quebra de linhas
        $texto = preg_replace('/[^\p{L}\p{N}\s]/u', '', $texto);

        $palavras = explode(' ', $texto);

        #Palavras desnecessarias para o texto, e que irao me atrapalhar na busca
        $palavrasDesnecessarias = [
            'de',
            'da',
            'do',
            'a',
            'o',
            'em',
            'esse',
            'essa',
            'este',
            'esta',
            'para',
            'com',
            'que',
            'e',
            'um',
            'num',
            'implementar',
            'projetar',
            'estudar',
            'resultados'
        ];

        #Filtrando as palavras desnecessarias
        $palavras = array_filter($palavras, fn($p) =>
            !in_array($p, $palavrasDesnecessarias) && strlen($p) > 3);

        #Pego a frequencia de cada palavra
        $frequencia = array_count_values($palavras);
        arsort($frequencia);

        #pego somente as 20 primeiras, pra dar o suficiente para o chart
        $data = array_slice($frequencia, 0, 20, true);

        return $data;
    }
}


