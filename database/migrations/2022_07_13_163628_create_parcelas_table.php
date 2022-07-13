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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();

            $table->float('valor', 10, 2);
            $table->integer('numero');
            $table->dateTime('data_vencimento');
            $table->dateTime('data_pagamento')->nullable();
            $table->float('taxa_multa', 10, 2)->nullable();
            $table->float('valor_pago', 10, 2);
            $table->string('status', 255)->default('ABERTA');

            $table->foreignId('emprestimo_id')
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
        Schema::dropIfExists('parcelas');
    }
};
