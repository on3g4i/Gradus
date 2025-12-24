<?php

use App\Models\Tcc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documento', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 255)->default(null);
            $table->string('autor', 255)->default(null);
            $table->string('permissao', 45)->default(null);
            $table->string('url', 255)->default(null);
            $table->foreignIdFor(Tcc::class)->constrained('tcc');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento');
    }
};
