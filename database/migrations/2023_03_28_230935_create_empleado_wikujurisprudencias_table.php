<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoWikujurisprudenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_wikujurisprudencias', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('wikujurisprudencia_id')->nullable();
            $table->foreign('wikujurisprudencia_id', 'fk_wikuargumento_wikujurisprudencia_usu')->references('id')->on('wikujurisprudencia')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'fk_empleado_wikujurisprudencia_usu')->references('id')->on('empleados')->onDelete('restrict')->onUpdate('restrict');
            $table->string('radicado', 255);
            $table->date('fecha')->nullable();
            $table->string('archivo', 255)->nullable();
            $table->unsignedBigInteger('subsala_id');
            $table->foreign('subsala_id', 'fk_usu_subsala_jurisprudencia')->references('id')->on('wikusubsala')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('magistrado_id');
            $table->foreign('magistrado_id', 'fk_usu_magistrado_jurisprudencia')->references('id')->on('wikumagistrado')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('demandante_id')->nullable();
            $table->foreign('demandante_id', 'fk_usu_demandante_jurisprudencia')->references('id')->on('wikudemandante')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('demandado_id')->nullable();
            $table->foreign('demandado_id', 'fk_usu_demandado_jurisprudencia')->references('id')->on('wikudemandado')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('wikutemaespecifico_id')->nullable();
            $table->foreign('wikutemaespecifico_id', 'fk_usu_temaespecifico_jurisprudencia')->references('id')->on('wikutemaespecifico')->onDelete('restrict')->onUpdate('restrict');
            $table->longText('texto');
            $table->longText('descripcion')->nullable();
            $table->bigInteger('destacado')->default(0);
            $table->bigInteger('estado')->default(1);
            $table->text('observacion');
            $table->text('respuesta');
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
        Schema::dropIfExists('empleado_wikujurisprudencias');
    }
}
