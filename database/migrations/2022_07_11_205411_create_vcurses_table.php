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
        Schema::create('vcourses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            //
            $table->unsignedInteger('taken');
            $table->unsignedInteger('capacity');
            //
            $table->unsignedInteger('duration_week');
            //
            $table->unsignedBigInteger('id_instructor');
            $table->unsignedBigInteger('id_room');
            $table->foreign('id_instructor')
                ->references('id')
                ->on('instructors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_room')
                ->references('id')
                ->on('rooms')
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
        Schema::dropIfExists('vcourses');
    }
};
