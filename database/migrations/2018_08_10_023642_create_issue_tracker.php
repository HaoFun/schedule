<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_tracker', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('issue_id')->index()->comment('議題關聯ID');
            $table->unsignedInteger('tracker_id')->index()->comment('追蹤標籤關聯ID');
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
        Schema::dropIfExists('issue_tracker');
    }
}
