<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type')->default('1')->after('id');
            // Физ лицо
            $table->string('last_name', 255)->after('user_type');
            $table->string('middle_name', 255)->nullable()->after('name');
            $table->string('phone', 50)->after('email');
            $table->string('phone2', 50)->nullable()->after('phone');
            $table->string('identifier', 50)->after('phone');
            // Юр лицо
            $table->string('organization_name', 255)->nullable()->after('identifier');
            $table->text('address')->nullable()->after('organization_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_type', 'last_name', 'middle_name', 'phone', 'phone2', 'identifier', 'organization_name', 'address']);
        });
    }
}
