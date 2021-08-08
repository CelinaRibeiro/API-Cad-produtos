<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned(); // Id da tabela categories
            $table->string('name', 200);
            $table->text('description')->nullable(); 
            $table->date('expiration_date');
            $table->double('price');
            $table->foreign('category_id')->references('id')->on('categories'); // Define o campo como chave extrangeira (foreign key)
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
}
