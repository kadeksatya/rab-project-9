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
        Schema::table('r_a_b_details', function (Blueprint $table) {
            $table->double('volume', 16, 4)->change();
            $table->double('price', 16, 4)->change();
            $table->double('sub_amount', 16, 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('r_a_b_details', function (Blueprint $table) {
            //
        });
    }
};
