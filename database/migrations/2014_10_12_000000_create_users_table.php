<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->char('permission_type')->default('R')->comment('R = Role / P = Permissions');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_no')->unique();
            $table->char('theme', 1)->comment('L = Light, D = Dark')->default('L');
            $table->string('password');
            $table->char('status', 1)->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
