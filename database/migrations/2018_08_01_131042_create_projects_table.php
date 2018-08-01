<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manager')->comment('管理者');
            $table->unsignedInteger('assignee')->comment('被派發者');
            $table->string('project_name', 50)->index()->comment('專案名稱');
            $table->string('status', 10)->index()->comment('專案狀態');
            $table->string('priority', 10)->index()->comment('專案優先權');
            $table->string('remark', 255)->nullable()->comment('備注');
            $table->timestamp('created_date')->nullable()->comment('專案開始日期');
            $table->timestamp('due_date')->nullable()->comment('預計完成日期');
            $table->timestamp('completed_date')->nullable()->comment('實際完成日期');
            $table->timestamp('release_date')->nullable()->comment('專案結束日期');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
        Schema::dropIfExists('projects');
    }
}
