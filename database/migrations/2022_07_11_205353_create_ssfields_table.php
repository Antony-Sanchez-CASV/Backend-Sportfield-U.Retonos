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
        Schema::create('ssfields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sField');
            $table->unsignedBigInteger('id_schedule');

            $table->foreign('id_sField')
                   ->references('id')
                   ->on('s_fields')
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
        Schema::dropIfExists('ssfields');
    }
};
