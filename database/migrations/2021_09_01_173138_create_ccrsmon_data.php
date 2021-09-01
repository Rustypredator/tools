<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcrsmonData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_ccrsmon_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system');
            $table->json('items');
            $table->json('tasks');
            $table->json('fluids');
            $table->json('patterns');
            $table->json('energyUsage');
            $table->json('energyStorage');
            $table->json('storages');
            $table->ipAddress('source');
            $table->addedAt()->useCurrent();
            $table->foreign('system')->references('id')->on('tools_ccrsmon_systems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools_ccrsmon_data');
    }
}
