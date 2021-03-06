<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lights', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name', 60);
            $table->string('port', 60);
            $table->boolean('port_status')->default(0);
             $table->integer('module_id')->unsigned();
            $table->foreign('module_id')
                   ->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lights');
    }
}
