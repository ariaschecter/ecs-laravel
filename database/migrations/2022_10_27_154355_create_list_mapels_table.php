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
        Schema::create('list_mapels', function (Blueprint $table) {
            $table->id('list_mapel_id');
            $table->foreignId('sub_mapel_id');
            $table->integer('list_mapel_no');
            $table->string('list_mapel_name');
            $table->string('list_mapel_link');
            $table->text('list_mapel_desc');
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
        Schema::dropIfExists('list_mapels');
    }
};
