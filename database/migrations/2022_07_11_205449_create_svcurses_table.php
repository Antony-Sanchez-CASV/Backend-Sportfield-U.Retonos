<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svcourses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vcourse');
            $table->unsignedBigInteger('id_schedule');
            $table->foreign('id_vcourse')
                ->references('id')
                ->on('vcourses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_schedule')
                ->references('id')
                ->on('schedules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('svcourses');
    }
};
