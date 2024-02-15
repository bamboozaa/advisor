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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('adv_id', 10);
            $table->string('student_id', 13);
            $table->integer('project');
            $table->text('title_research');
            $table->text('title_research_en')->nullable();
            $table->string('publisher')->nullable();
            $table->char('publishing_year', 4)->nullable();
            $table->integer('project_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
