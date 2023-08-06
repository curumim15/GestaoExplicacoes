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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telemovel')->unique();
            $table->dateTime('dataNascimento');
            $table->decimal('credito', 8, 2)->default(0);
            $table->string('avatar')->default('/images/default.png');
            $table->enum('genero', ['masculino', 'feminino'])->nullable();
            $table->enum('estado', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->unsignedBigInteger('role_id')->default(3);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
