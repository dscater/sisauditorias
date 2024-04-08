<?php

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
        Schema::create('etapa_nombres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("etapa_auditoria_id");
            $table->integer("nro_etapa");
            $table->string("nombre", 255);
            $table->timestamps();

            $table->foreign("etapa_auditoria_id")->on("etapa_auditorias")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapa_nombres');
    }
};
