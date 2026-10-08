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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id(); // Primary key (calendar_id)
            $table->string('month'); // Month name
            $table->date('date'); // Specific date
            $table->string('days'); // Day of the week
            $table->text('activity')->nullable(); // Description of the event/activity
            $table->boolean('holidays')->default(false); // True if it's a holiday
            $table->string('working_details')->nullable(); // Additional details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
