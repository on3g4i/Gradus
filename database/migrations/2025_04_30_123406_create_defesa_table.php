<?php

use App\Models\Tcc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('defesa', function (Blueprint $table) {
            $table->id();
            $table->string('banca', 255)->default(null);
            $table->string('atas_url', 255)->default(null);
            $table->string('fichas_avaliacao', 255)->default(null);
            $table->foreignIdFor(Tcc::class)->constrained('tcc');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defesa');
    }
};
