<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type')->default(1);
            $table->string('last_name');
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('organization_name')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('identifier');
            $table->string('password');
            $table->string('remember_token');
            $table->string('user_id');
            $table->boolean('verified')->default(false);
            $table->date('registration_request');
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
        Schema::dropIfExists('temporary_users');
    }
}
