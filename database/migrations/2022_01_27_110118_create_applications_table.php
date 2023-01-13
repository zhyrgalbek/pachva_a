<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('code')->nullable()->unique();
            $table->text('service_name');
            $table->text('sent_data');
            $table->text('details_data')->nullable();
            $table->text('received_data')->nullable();
            $table->string('path_to_QR')->nullable();
            $table->bigInteger('member_id');
            $table->bigInteger('application_sbk_id');
            $table->string('member_name');
            $table->string('member_identifier');
            $table->string('status')->default('sent');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
