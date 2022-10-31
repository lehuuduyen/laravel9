<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id')
                ->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')
                ->references('id')->on('category')->onDelete('cascade');

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
        Schema::dropIfExists('events');
    }
}
