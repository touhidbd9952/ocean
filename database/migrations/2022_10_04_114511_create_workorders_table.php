<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->integer('cusid');
            $table->integer('worktypeid');
            $table->integer('workid');
            $table->string('work_place')->nullable();
            $table->string('workstart');
            $table->integer('work_status')->default(0); //0 new added, 1 work offer to freeman, 2 no response, 3 cancel by cus
            $table->integer('state')->default(0); //0 unlock, 1 lock  
                                                  // when unlock, every freeman can see and can give "interest" on it
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
        Schema::dropIfExists('workorders');
    }
}
