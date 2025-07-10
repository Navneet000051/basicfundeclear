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
        Schema::create('aboutcontent', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->text('subheading')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(1);
            $table->string('metatitle')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('metakey')->nullable();
            $table->integer('position_by')->nullable();
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
        Schema::dropIfExists('aboutcontent');
    }
};
