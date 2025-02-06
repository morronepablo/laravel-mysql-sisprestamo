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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('nro_documento', 20)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('email', 100);
            $table->string('celular', 20);
            $table->string('ref_celular');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
