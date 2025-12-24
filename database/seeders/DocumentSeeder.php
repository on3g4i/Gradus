<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\Tcc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tcc_random = Tcc::all()->random();
        Documento::factory()->count(5)->create([
            'tcc_id' => $tcc_random,
            'autor_id' => $tcc_random->orientador
        ]);
    }
}
