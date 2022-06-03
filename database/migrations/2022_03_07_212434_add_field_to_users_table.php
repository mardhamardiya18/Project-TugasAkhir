<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address_one');
            $table->longText('address_two');
            $table->integer('provinces_id');
            $table->integer('regencies_id');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('phone_number');
            $table->string('store_name');
            $table->integer('categories_id');
            $table->integer('store_status');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address_one');
            $table->dropColumn('address_two');
            $table->dropColumn('provinces_id');
            $table->dropColumn('regencies_id');
            $table->dropColumn('zip_code');
            $table->dropColumn('country');
            $table->dropColumn('phone_number');
            $table->dropColumn('store_name');
            $table->dropColumn('categories_id');
            $table->dropColumn('store_status');
        });
    }
}
