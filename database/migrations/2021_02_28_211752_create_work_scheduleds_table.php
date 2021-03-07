<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkScheduledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workScheduleds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('days');
            $table->string('workTime');
            $table->string('employeeNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workScheduleds');
    }
}
