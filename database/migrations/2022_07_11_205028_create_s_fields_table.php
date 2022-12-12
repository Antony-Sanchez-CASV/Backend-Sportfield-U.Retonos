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
        Schema::create('s_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name',10);
            $table->unsignedBigInteger('id_activity');
            $table->unsignedBigInteger('id_sector');
            $table->foreign('id_activity')
                   ->references('id')
                   ->on('activities')
                   ->onDelete('cascade');
            $table->foreign('id_sector')
                   ->references('id')
                   ->on('sectors')
                   ->onDelete('cascade');
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
        Schema::dropIfExists('s_fields');
    }
};
