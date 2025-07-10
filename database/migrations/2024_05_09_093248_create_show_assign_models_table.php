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
        Schema::create('showassign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showtype_id')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('url')->nullable();
            $table->boolean('status')->default(1);
            $table->string('metatitle')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('metakey')->nullable();
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
        Schema::dropIfExists('showassign');
    }
};
