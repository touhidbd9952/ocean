<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_regs', function (Blueprint $table) {
            $table->id();
            $table->string('s_code')->nullable();
            $table->string('title')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('photo_l')->nullable();
            $table->string('photo_s')->nullable();
            $table->string('status')->default('active');
            $table->string('reset_pass')->nullable(); //number will add, who many time password reseted
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
        Schema::dropIfExists('customer_regs');
    }
}
