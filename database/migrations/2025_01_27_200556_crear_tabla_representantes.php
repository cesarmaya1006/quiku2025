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
        Schema::create('representantes', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('tipo_documentos_id');
            $table->foreign('tipo_documentos_id', 'fk_representante_tipo_documentos')->references('id')->on('tipo_documentos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('identificacion', 100)->unique();
            $table->string('nombre1', 50);
            $table->string('nombre2', 50)->nullable();
            $table->string('apellido1', 50);
            $table->string('apellido2', 50)->nullable();
            $table->string('telefono_fijo', 30)->nullable();
            $table->string('telefono_celu', 30);
            $table->string('direccion', 255);
            $table->unsignedBigInteger('pais_id');
            $table->foreign('pais_id', 'fk_pais_representante')->references('id')->on('pais')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id', 'fk_municipio_representante')->references('id')->on('municipio')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nacionalidad', 100);
            $table->string('grado', 100);
            $table->string('genero', 20);
            $table->date('fecha_nacimiento');
            $table->string('grupo_etnico', 255);
            $table->boolean('discapacidad')->default(0);
            $table->string('tipo_discapacidad', 255)->nullable();
            $table->string('email')->unique();
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
