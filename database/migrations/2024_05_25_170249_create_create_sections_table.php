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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('section')->unique(); // Unique and integer column for section
            $table->string('heading'); // Column for heading
            $table->text('subheading'); // Column for subheading
            $table->integer('position_by')->nullable();
            $table->boolean('status')->default(1); // Boolean column for status with default value of true
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
        Schema::dropIfExists('sections');
    }
};
