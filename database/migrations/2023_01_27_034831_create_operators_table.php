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
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('operator_name', 100);
            $table->string('menara_name', 50);
            $table->string('address', 100);
            $table->string('city', 20);
            $table->string('country', 20);
            $table->string('postal', 10);
            $table->string('longtitude', 100);
            $table->string('latitude', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operators');
    }
};
