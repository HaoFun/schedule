<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->comment('專案 ID 關聯');
            $table->string('tracker_id', 10)->comment('追蹤 ID 關聯');
            $table->string('title', 50)->comment('議題標題');
            $table->string('status', 10)->index()->comment('議題狀態');
            $table->string('priority', 10)->index()->comment('議題優先權');
            $table->string('remark', 255)->nullable()->comment('備注');
            $table->timestamp('created_date')->nullable()->comment('議題開始日期');
            $table->timestamp('due_date')->nullable()->comment('預計完成日期');
            $table->timestamp('completed_date')->nullable()->comment('實際完成日期');
            $table->timestamp('release_date')->nullable()->comment('議題結束日期');
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
        Schema::dropIfExists('issues');
    }
}
