<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('issue_id')->index()->comment('議題 ID 關聯');
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
        Schema::dropIfExists('issues_users');
    }
}
