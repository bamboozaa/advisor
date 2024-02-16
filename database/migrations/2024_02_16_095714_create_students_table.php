<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 13);
            // $table->string('lec_id', 10);
            $table->string('std_title', 100)->nullable();
            $table->string('std_fname')->nullable();
            $table->string('std_lname')->nullable();
            $table->integer('dep_id');
            $table->integer('fac_id')->nullable();
            // $table->string('programname');
            $table->string('major')->nullable();
            $table->char('academic_year', 4);
            // $table->year('academic_year');
            $table->integer('semester')->default(1);
            // $table->integer('project');
            // $table->text('title_research');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
