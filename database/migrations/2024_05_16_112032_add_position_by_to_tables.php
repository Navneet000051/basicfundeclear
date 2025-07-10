<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionByToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('show', function (Blueprint $table) {
            $table->integer('position_by')->nullable();
        });

        Schema::table('showassign', function (Blueprint $table) {
            $table->integer('position_by')->nullable();
        });

        Schema::table('showtype', function (Blueprint $table) {
            $table->integer('position_by')->nullable();
        });

        Schema::table('short', function (Blueprint $table) {
            $table->integer('position_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('show', function (Blueprint $table) {
            $table->dropColumn('position_by');
        });

        Schema::table('showassign', function (Blueprint $table) {
            $table->dropColumn('position_by');
        });

        Schema::table('showtype', function (Blueprint $table) {
            $table->dropColumn('position_by');
        });

        Schema::table('short', function (Blueprint $table) {
            $table->dropColumn('position_by');
        });
    }
}
