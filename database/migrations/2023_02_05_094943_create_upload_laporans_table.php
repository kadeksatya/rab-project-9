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
        Schema::create('upload_laporans', function (Blueprint $table) {
            $table->id();
            $table->integer('rab_id');
            $table->text('name');
            $table->text('document');
            $table->string('status', 100)->default('WAITING_APPROVAL');
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
        Schema::dropIfExists('upload_laporans');
    }
};
