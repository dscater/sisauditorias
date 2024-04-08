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
        Schema::create('papel_archivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("papel_detalle_id");
            $table->string("archivo", 255);
            $table->string("ext");
            $table->timestamps();

            $table->foreign("papel_detalle_id")->on("papel_detalles")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papel_archivos');
    }
};
