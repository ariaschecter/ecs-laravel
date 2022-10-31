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
        Schema::create('sub_mapels', function (Blueprint $table) {
            $table->id('sub_mapel_id');
            $table->foreignId('mapel_id');
            $table->integer('sub_mapel_no');
            $table->string('sub_mapel_name');
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
        Schema::dropIfExists('sub_mapels');
    }
};
