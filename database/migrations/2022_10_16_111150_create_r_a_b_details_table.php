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
        Schema::create('r_a_b_details', function (Blueprint $table) {
            $table->id();
            $table->integer('rab_id');
            $table->integer('work_category_id');
            $table->integer('work_id');
            $table->double('volume', 16, 2 )->default(0);
            $table->string('unit', 100);
            $table->double('price', 16, 2 )->default(0);
            $table->double('sub_amount', 16, 2 )->default(0);
            $table->tinyInteger('is_overbudget')->default(0);
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
        Schema::dropIfExists('r_a_b_details');
    }
};
