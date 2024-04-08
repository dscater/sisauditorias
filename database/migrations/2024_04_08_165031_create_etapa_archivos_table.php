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
        Schema::create('etapa_archivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("etapa_nombre_id");
            $table->string("archivo", 255);
            $table->string("ext", 155);
            $table->timestamps();

            $table->foreign("etapa_nombre_id")->on("etapa_nombres")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapa_archivos');
    }
};
