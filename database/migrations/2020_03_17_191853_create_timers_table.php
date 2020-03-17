<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timers', function (Blueprint $table) {
            $table->increments('timerId');
            $table->string('name');
            $table->unsignedInteger('projectId');
            $table->unsignedInteger('userId');
            $table->timestamp('startedAt');
            $table->timestamp('stoppedAt')->default(null)->nullable();
            $table->timestamps();
            $table->foreign('userId')->references('userId')->on('users');
            $table->foreign('projectId')->references('projectId')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timers');
    }
}
