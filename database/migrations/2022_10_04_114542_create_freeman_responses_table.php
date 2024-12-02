<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreemanResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeman_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('workorderid');
            $table->integer('freemanid');
            $table->integer('status')->default(0); //0 no response, 1 interest, 2 cancel
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
        Schema::dropIfExists('freeman_responses');
    }
}
