<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreemanBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeman_books', function (Blueprint $table) {
            $table->id();
            $table->integer('workorderid');
            $table->integer('freemanid');
            $table->integer('book_status')->default(0); //0 book by customer, 1 cancel by freeman
            $table->integer('workstatus')->default(1); //0 work complete, 1 work not complete
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
        Schema::dropIfExists('freeman_books');
    }
}
