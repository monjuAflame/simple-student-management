<?php

use App\Models\Course;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default('Default Course Name');
            $table->string('code', 30)->nullable();
            $table->integer('fee');
            $table->string('course_type')->nullable()->default(Course::ADMISSION_TYPE_ADMISSION);
            $table->foreignId('creator_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
