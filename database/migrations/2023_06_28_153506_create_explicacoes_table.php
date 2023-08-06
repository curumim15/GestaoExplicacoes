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
        Schema::create('explicacoes', function (Blueprint $table) {
            $table->id();
            $table->string('disciplina');
            $table->integer('max_alunos');
            $table->dateTime('data_hora');
            $table->text('descricao');
            $table->decimal('preco', 8, 2);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('explicacoes');
    }
};
