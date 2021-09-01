<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcrsmonSystems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_ccrsmon_systems', function (Blueprint $table) {
            $table->id();
            $table->text('key');
            $table->foreignId('owner')->nullable();
            $table->timestamp('registered_at')->useCurrent();
            $table->foreign('owner')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools_ccrsmon_systems');
    }
}
