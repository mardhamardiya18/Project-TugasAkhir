<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_details', function (Blueprint $table) {
            $table->id();
            $table->integer('custom_id');
            $table->string('estimasi_pengerjaan');
            $table->string('estimasi_biaya');
            $table->string('status_pengerjaan');

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
        Schema::dropIfExists('custom_details');
    }
}
