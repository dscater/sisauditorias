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
        Schema::create('institucions', function (Blueprint $table) {
            $table->id();
            $table->string("institucion", 255);
            $table->string("nombre_sistema", 255);
            $table->string("nit", 255);
            $table->string("img_organigrama")->nullable();
            $table->text("mision")->nullable();
            $table->text("vision")->nullable();
            $table->text("principios")->nullable();
            $table->text("valores")->nullable();
            $table->text("administracion")->nullable();
            $table->text("codigo_etica")->nullable();
            $table->text("informacion_financiera")->nullable();
            $table->text("ubicacion_google")->nullable();
            $table->string("ciudad", 255)->nullable();
            $table->string("dir", 255)->nullable();
            $table->string("fonos", 255)->nullable();
            $table->string("horario", 255)->nullable();
            $table->string("correo", 255)->nullable();
            $table->string("logo", 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucions');
    }
};
