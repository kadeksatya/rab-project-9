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
        Schema::create('work_details', function (Blueprint $table) {
            $table->id();
            $table->integer('work_id');
            $table->integer('type_data');
            $table->integer('value_id');
            $table->double('koefisien', 16, 2);
            $table->string('unit', 100);
            $table->double('price', 16, 2);            
            $table->double('sub_amount', 16, 2);            
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
        Schema::dropIfExists('work_details');
    }
};
