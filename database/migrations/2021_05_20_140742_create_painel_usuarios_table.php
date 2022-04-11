<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePainelUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('painel_usuarios', function (Blueprint $table) {
            $table->id();
            $table->text('nome');
            $table->text('email');
            $table->text('senha');
            $table->text('nivel');
            $table->text('nomd5');
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
        Schema::dropIfExists('painel_usuarios');
    }
}
