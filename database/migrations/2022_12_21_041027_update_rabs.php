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
            $table->double('construction_service', 16, 4)->change();
            $table->double('real_cost', 16, 4)->change();
            $table->double('rounded_up_cost', 16, 4)->change();
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
