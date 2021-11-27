<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mascotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('NombreUsuario', 30);
            $table->string('Nombre', 30);
            $table->integer('Edad');
            $table->float('Peso', 2, 2);
            $table->string('Tamano', 25);
            $table->string('Especie', 25);
            $table->string('Raza', 25);
            $table->string('Imagen', 2500);
            $table->text('Descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
