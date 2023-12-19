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
        Schema::create('advisers', function (Blueprint $table) {
            $table->id();
            $table->string('lec_id', 10)->unique();
            $table->string('personal_id', 13)->nullable();
            $table->string('user_name', 20)->nullable();
            $table->string('lec_title1', 13)->nullable();
            $table->string('lec_titile2', 50)->nullable();
            $table->string('lec_fname', 100)->nullable();
            $table->string('lec_lname', 100)->nullable();
            $table->string('academic_name', 50)->nullable();
            $table->string('abbreviation', 10)->nullable();
            $table->string('major', 100)->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisers');
    }
};
