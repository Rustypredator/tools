<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CcrsmonDataAddProcessed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ccrsmon_data', function (Blueprint $table) {
            $table->json('processed')->after('system');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ccrsmon_data', function (Blueprint $table) {
            $table->dropColumn('processed');
        });
    }
}
