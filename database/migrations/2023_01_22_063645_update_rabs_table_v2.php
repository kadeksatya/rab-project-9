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
        Schema::table('r_a_b_s', function (Blueprint $table) {
            $table->double('rab_cost', 16, 2)->default(0);
            $table->double('cco_cost', 16, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('r_a_b_s', function (Blueprint $table) {
            //
        });
    }
};
