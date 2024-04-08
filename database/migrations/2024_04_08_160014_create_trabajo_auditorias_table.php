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
        Schema::create('trabajo_auditorias', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 255);
            $table->string("codigo", 255);
            $table->unsignedBigInteger("tipo_trabajo_id");
            $table->string("empresa", 255);
            $table->unsignedBigInteger("responsable_id");
            $table->string("objeto", 255);
            $table->string("objetivo", 255);
            $table->string("periodo", 255);
            $table->date("fecha_ini");
            $table->string("duracion"); //HABILIES/CALENDARIO
            $table->date("fecha_entrega");
            $table->date("fecha_registro");
            $table->timestamps();


            $table->foreign("tipo_trabajo_id")->on("tipo_trabajos")->references("id");
            $table->foreign("responsable_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajo_auditorias');
    }
};
