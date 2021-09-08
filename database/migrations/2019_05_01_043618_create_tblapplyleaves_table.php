<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblapplyleavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblApplyLeaves', function (Blueprint $table) {
            $table->increments('ApplyLeaveNum');
            $table->string('Name');
            $table->string('Email');
            $table->string('Department');
            $table->string('Status');
            $table->string('StartDate');
            $table->string('EndDate');
            $table->string('Reason');
            $table->string('Type');

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
        Schema::dropIfExists('tblApplyLeaves');
    }
}
