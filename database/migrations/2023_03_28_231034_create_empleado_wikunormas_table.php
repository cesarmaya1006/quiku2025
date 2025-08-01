<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoWikunormasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_wikunormas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('wikunorma_id')->nullable();
            $table->foreign('wikunorma_id', 'fk_wikunorma_wikunormas_usu')->references('id')->on('wikunormas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'fk_empleado_wikunormas_usu')->references('id')->on('empleados')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('fuente_id');
            $table->foreign('fuente_id', 'fk_usu_fuente_document')->references('id')->on('wikudocument')->onDelete('restrict')->onUpdate('restrict');
            $table->string('articulo', 255);
            $table->date('fecha')->nullable();
            $table->longText('texto');
            $table->longText('descripcion')->nullable();
            $table->string('libro', 255)->nullable();
            $table->string('parte', 255)->nullable();
            $table->string('seccion', 255)->nullable();
            $table->string('titulo', 255)->nullable();
            $table->string('capitulo', 255)->nullable();
            $table->unsignedBigInteger('wikutemaespecifico_id')->nullable();
            $table->foreign('wikutemaespecifico_id', 'fk_usu_temaespecifico_norma')->references('id')->on('wikutemaespecifico')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('empleado_wikunormas');
    }
}
