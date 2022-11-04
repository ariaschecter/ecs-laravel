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
        Schema::create('access_mapels', function (Blueprint $table) {
            $table->id('access_mapel_id');
            $table->foreignId('id');
            $table->foreignId('mapel_id');
            $table->integer('count_sub_mapel');
            $table->integer('count_list_mapel');
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
        Schema::dropIfExists('access_mapels');
    }
};
