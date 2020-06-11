<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprietariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('fixo',20)->nullable();
            $table->string('cpf',20)->nullable();
            $table->string('cep',9)->nullable();
            $table->string('rua',60)->nullable();
            $table->string('numero',30)->nullable();
            $table->string('complemento',60)->nullable();
            $table->string('bairro',30)->nullable();
            $table->string('cidade',30)->nullable();
            $table->string('uf',2)->nullable();
            $table->string('pais',30)->nullable();
            $table->index('nome');
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
        Schema::dropIfExists('proprietarios');
    }
}
