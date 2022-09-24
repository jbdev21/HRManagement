<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('category_id');
            $table->date('date_filling');
            $table->string('details');
            $table->integer('no_working_days_applied');
            $table->enum('commutation', ['not_requested', 'requested'])->default('not_requested');
            $table->enum('recommendation', ['approval', 'disapproval'])->default('approval');
            $table->string('disapproval_details')->nullable(true);
            $table->integer('day_pay')->nullable(true);
            $table->integer('day_without_pay')->nullable(true);
            $table->string('others')->nullable(true);
            
            $table->integer('points_deduction_vacation')->nullable(true);
            $table->integer('points_deduction_sick')->nullable(true);
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
        Schema::dropIfExists('leaves');
    }
}
