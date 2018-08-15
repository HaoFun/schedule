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
            $table->string('title', 50)->index()->comment('專案名稱');
            $table->unsignedTinyInteger('status')->index()->comment('專案狀態(1:新建立/2:提案中/3:實做中/4:已結案)');
            $table->unsignedTinyInteger('priority')->index()->comment('專案優先度(1:高/2:正常/3:低)');
            $table->string('remark', 255)->nullable()->comment('備注');
            $table->timestamp('created_date')->index()->nullable()->comment('專案開始日期');
            $table->timestamp('due_date')->index()->nullable()->comment('預計完成日期');
            $table->timestamp('completed_date')->index()->nullable()->comment('實際完成日期');
            $table->timestamp('release_date')->index()->nullable()->comment('專案結束日期');
            $table->unsignedInteger('created_by')->comment('新增者');
            $table->unsignedInteger('updated_by')->comment('更新者');
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
