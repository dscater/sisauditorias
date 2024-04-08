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
        Schema::create('papel_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("papel_trabajo_id");
            $table->integer("nro_etapa");
            $table->integer("nro_nombre");
            $table->string("aplicabilidad", 255)->nullable();
            $table->string("estado", 255)->nullable();
            $table->timestamps();

            $table->foreign("papel_trabajo_id")->on("papel_trabajos")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papel_detalles');
    }
};
