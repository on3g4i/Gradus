<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tcc', function (Blueprint $table) {
            //Usando somente a tabela de Documentos
            if (Schema::hasColumns('tcc', ['termo_url', 'historico_url', 'solicitacao_url'])) {
                $table->dropColumn(['termo_url', 'historico_url', 'solicitacao_url']);
            }
             if (!Schema::hasColumns('tcc', ['dia_defesa'])) {
                $table->timestamp('dia_defesa')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
