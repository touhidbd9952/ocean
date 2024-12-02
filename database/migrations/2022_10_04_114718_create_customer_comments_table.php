<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('cusid');
            $table->integer('workorderid');
            $table->integer('order_final_status')->default(0); //0 not done, 1 work done, 2 cancel
            $table->integer('ratingpoint')->default(0); // 0 satisfied, 1 good, 2 not good, 3 bad
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
        Schema::dropIfExists('customer_comments');
    }
}
