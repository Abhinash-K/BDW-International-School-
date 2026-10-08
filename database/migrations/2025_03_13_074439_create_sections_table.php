<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('section_id'); // Explicitly setting section_id as the primary key
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('section_name'); // Example: A, B, C
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
