<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Defesa;
use App\Models\Documento;
use App\Models\Orientador;
use App\Models\Tcc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Tcc::factory()->count(10)->state(
            new Sequence(
                fn(Sequence $sequence) => [
                    'aluno_id' => User::where('tipo_usuario', '=', 'aluno')->get()->random(),
                    'orientador_id' => User::where('tipo_usuario', '=', 'orientador')->get()->random(),
                    'dia_defesa' => function () {
                        $minYearsAhead = 2;    // mínimo: 2 anos no futuro
                        $maxYearsAhead = 5;    // opcional: até quantos anos no futuro (ajuste se quiser)
            
                        $now = Carbon::now();
                        $minYear = $now->copy()->addYears($minYearsAhead)->year;
                        $maxYear = $now->copy()->addYears($maxYearsAhead)->year;

                        $year = rand($minYear, $maxYear);
                        $month = rand(1, 12);

                        // garante o dia válido para o mês/ano (considera fevereiro e anos bissextos)
                        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
                        $day = rand(1, $daysInMonth);

                        return Carbon::createFromDate($year, $month, $day)->toDateString(); // formato 'YYYY-MM-DD'
                    }

                ]
            )
        )
            ->has(Defesa::factory(), 'defesas')
            ->create();
    }
}
