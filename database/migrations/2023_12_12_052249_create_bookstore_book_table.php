<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookstoreBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookstore_book', function (Blueprint $table) {
            $table->id();
            // unsigne無符號整數 代表只能正整數
            $table->unsignedBigInteger('bookstore_id');
            $table->unsignedBigInteger('book_id');
       
            $table->timestamps();
            $table->foreign('bookstore_id')->references('id')->on('bookstores')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookstore_book');
    }
}
