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
        Schema::create('r_a_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamp('project_date');
            $table->double('construction_service', 16, 2)->default(0);
            $table->double('real_cost', 16, 2)->default(0);
            $table->double('rounded_up_cost', 16, 2)->default(0);
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
        Schema::dropIfExists('r_a_b_s');
    }
};
