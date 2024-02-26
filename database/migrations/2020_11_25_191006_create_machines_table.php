<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('site');
            $table->string('machine_name');
            $table->string('number_plate')->unique();
            $table->string('model_number');
            $table->string('worked_hours');
            $table->string('plan')->nullable();
            $table->string('plan_hours')->nullable();
            $table->string('process_owner')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->boolean('schedule_status')->default(0);
            $table->boolean('approved_plan')->default(0);
            $table->boolean('completed')->default(0);
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('machines');
    }
}
