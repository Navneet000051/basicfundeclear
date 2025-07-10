<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'address', 'role_id', 'icon', 'status']);
        });
    }
}
