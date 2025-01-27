<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaDocimpugnacionInterna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docimpugnacion_interna', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('impugnacion_interna_id');
            $table->foreign('impugnacion_interna_id', 'fk_impugnacion_interna_doc')->references('id')->on('impugnacion_interna')->onDelete('restrict')->onUpdate('restrict');
            $table->string('titulo', 255);
            $table->longText('descripcion')->nullable();
            $table->string('url', 255);
            $table->string('extension', 255);
            $table->double('peso');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docimpugnacion_interna');
    }
}
