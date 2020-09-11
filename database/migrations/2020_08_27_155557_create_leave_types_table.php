<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('maximum_days');
            $table->integer('carry_over_days');
            $table->string('gender');
            $table->boolean('can_use_partially')->default(false);
            $table->boolean('calendar_days')->default(false);
            $table->timestamps();
        });

        Schema::create('employment_type_leave_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employment_type_id');
            $table->integer('leave_type_id');
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
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('employment_type_leave_type');
    }
}
