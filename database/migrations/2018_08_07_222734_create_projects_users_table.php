<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->index()->comment('專案 ID 關聯');
            $table->unsignedInteger('user_id')->index()->comment('USER ID 關聯');
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
        Schema::dropIfExists('projects_users');
    }
}
