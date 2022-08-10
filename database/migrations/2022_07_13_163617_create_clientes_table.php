<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('cpf', 14)->unique();
            $table->string('nome', 255);
            $table->string('telefone', 20)->unique();
            $table->string('endereco', 255);
            $table->string('profissao', 255);
            $table->float('renda', 10, 2);
            $table->string('email', 255)->unique();
            $table->string('senha', 255);
            $table->string('tipo', 32)->default('CLIENTE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
