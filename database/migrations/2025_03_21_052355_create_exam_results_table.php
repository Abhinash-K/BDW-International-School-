<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('exam_results', function (Blueprint $table) {
        $table->id('result_id');
        $table->foreignId('student_id')->constrained('students', 'student_id')->onDelete('cascade');
        $table->foreignId('exam_id')->constrained('examinations')->onDelete('cascade');
        $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
        $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
        $table->integer('marks_obtained');
        $table->integer('total_marks');
        $table->string('grade')->nullable();
        $table->text('remarks')->nullable();
        $table->foreignId('calendar_id')->constrained('calendars')->onDelete('cascade');
        $table->year('year');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
