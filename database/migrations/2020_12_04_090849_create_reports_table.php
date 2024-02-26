<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('date');
            $table->string('owner');
            $table->string('site');
            $table->string('machine_name');
            $table->string('number_plate');
            $table->string('milage')->nullable();
            $table->string('plan')->nullable();
            $table->string('plan_hours');
            $table->string('type');
            $table->string('status')->default('pending');
            $table->string('approved_by')->nullable();
            $table->string('approved_date')->nullable();
            $table->string('admincomment')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
