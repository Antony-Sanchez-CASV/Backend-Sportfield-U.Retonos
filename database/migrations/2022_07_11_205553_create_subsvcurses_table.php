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
        Schema::create('subsvcourses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vcourse');//horario de curso

            $table->unsignedBigInteger('id_user');//morador

            $table->unsignedBigInteger('id_state');//estado

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('id_state')
                   ->references('id')
                   ->on('states')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

            $table->foreign('id_vcourse')
                   ->references('id')
                   ->on('vcourses')
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
        Schema::dropIfExists('subsvcourses');
    }
};
