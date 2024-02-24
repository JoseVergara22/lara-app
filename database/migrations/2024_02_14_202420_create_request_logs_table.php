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
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // Método HTTP (GET, POST, etc.)
            $table->string('path'); // Ruta de la petición
            $table->text('request_data')->nullable(); // Datos de la solicitud (puede ser JSON u otro formato)
            $table->text('response_data')->nullable(); // Datos de la respuesta (puede ser JSON u otro formato)
            $table->integer('status_code')->nullable(); // Código de estado de la respuesta HTTP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_logs');
    }
};
