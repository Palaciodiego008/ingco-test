<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaTareaTable extends Migration
{
    public function up()
    {
        Schema::create('etiqueta_tarea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('etiqueta_id');
            $table->unsignedBigInteger('tarea_id');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('etiqueta_tarea');
    }
}
