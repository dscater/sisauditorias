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
        Schema::create('papel_trabajos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("trabajo_auditoria_id");
            $table->timestamps();
            
            $table->foreign("trabajo_auditoria_id")->on("trabajo_auditorias")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papel_trabajos');
    }
};
