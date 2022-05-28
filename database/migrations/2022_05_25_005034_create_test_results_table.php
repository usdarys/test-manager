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
        Schema::create('test_results', function (Blueprint $table) {
            $table->integer('test_run_id');
            $table->integer('test_case_id');
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at');
            $table->enum('status', ['untested', 'passed', 'failed'])->default('untested');
            $table->text('comment')->nullable();
            $table->foreign('test_run_id')->references('id')->on('test_runs');
            $table->foreign('test_case_id')->references('id')->on('test_cases');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->primary(['test_run_id', 'test_case_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_results');
    }
};
