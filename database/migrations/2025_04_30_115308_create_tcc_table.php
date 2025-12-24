<?php

use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tcc', function (Blueprint $table) {
            $table->id();
            $table->string('termo_url', 255)->default(null);
            $table->string('historico_url', 255)->default(null);
            $table->string('solicitacao_url', 255)->default(null);
            $table->foreignIdFor(User::class, 'aluno_id')->constrained('users');
            $table->foreignIdFor(User::class, 'orientador_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tcc');
        Schema::enableForeignKeyConstraints();
    }
};
