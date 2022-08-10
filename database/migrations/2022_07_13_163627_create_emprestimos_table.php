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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();

            $table->string('nome', 255);
            $table->float('valor', 10, 2);
            $table->float('valor_final', 10, 2)->nullable();
            $table->float('taxa_juros', 10, 2)->default(20);
            $table->dateTime('data_solicitacao');
            $table->dateTime('data_quitacao')->nullable();
            $table->string('status', 255)->default('SOLICITADO');
            $table->integer('qtd_parcelas');

            $table->foreignId('cliente_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
};
