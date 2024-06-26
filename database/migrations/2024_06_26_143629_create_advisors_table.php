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
        Schema::create('advisors', function (Blueprint $table) {
            $table->id();
            $table->string('adv_id', 10)->unique();
            $table->string('adv_title', 13)->nullable();
            $table->string('adv_fname', 100)->nullable();
            $table->string('adv_lname', 100)->nullable();
            $table->integer('aca_id')->nullable();
            $table->integer('qua_id')->nullable();
            // $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisors');
    }
};
