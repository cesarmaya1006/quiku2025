<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoWikuargumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_wikuargumentos', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('tipo',50);
            $table->unsignedBigInteger('wikuargumento_id')->nullable();
            $table->foreign('wikuargumento_id', 'fk_wikuargumento_wikuargumentos_usu')->references('id')->on('wikuargumentos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'fk_empleado_wikuargumentos_usu')->references('id')->on('empleados')->onDelete('restrict')->onUpdate('restrict');
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('wikuautorinstitu_id')->nullable();
            $table->foreign('wikuautorinstitu_id', 'fk_usu_argumento_wikuautorinstitu')->references('id')->on('wikuautorinstitu')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('wikuautores_id')->nullable();
            $table->foreign('wikuautores_id', 'fk_usu_argumento_wikuautores')->references('id')->on('wikuautores')->onDelete('restrict')->onUpdate('restrict');
            $table->longText('texto');
            $table->longText('descripcion')->nullable();
            $table->unsignedBigInteger('wikutemaespecifico_id')->nullable();
            $table->foreign('wikutemaespecifico_id', 'fk_usu_temaespecifico_argumento')->references('id')->on('wikutemaespecifico')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('destacado')->default(0);
            $table->boolean('publico')->default(0);
            $table->bigInteger('estado')->default(1);
            $table->text('observacion');
            $table->text('respuesta')->nullable();
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
        Schema::dropIfExists('empleado_wikuargumentos');
    }
}
