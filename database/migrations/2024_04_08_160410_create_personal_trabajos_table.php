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
        Schema::create('personal_trabajos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("trabajo_auditoria_id");
            $table->unsignedBigInteger("personal_id"); //AUDITOR - SUPERVISOR
            $table->double("horas");
            $table->timestamps();

            $table->foreign("trabajo_auditoria_id")->on("trabajo_auditorias")->references("id");
            $table->foreign("personal_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_trabajos');
    }
};
