<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('leave_type_id');
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('number_of_days');
            $table->string('reason')->nullable();
            $table->integer('status')->default(0);
            $table->integer('employee_inplace');
            $table->integer('recommended_by')->nullable();
            $table->integer('approved_by')->nullable();
            $table->date('actioned_at')->nullable();
            $table->date('recalled_at')->nullable();
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
        Schema::dropIfExists('leave_requests');
    }
}
