<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPqrLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_pqr_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('pqr_id');
            $table->foreign('pqr_id', 'fk_pqr_fecha')->references('id')->on('pqr')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('estadospqr_id');
            $table->foreign('estadospqr_id', 'fk_estadospqr_fecha')->references('id')->on('estadospqr')->onDelete('restrict')->onUpdate('restrict');
            $table->date('fecha_cierre')->nullable();
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
        Schema::dropIfExists('estado_pqr_logs');
    }
}
