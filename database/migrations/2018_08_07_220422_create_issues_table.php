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
            $table->unsignedInteger('project_id')->index()->comment('專案關聯ID');
            $table->string('title', 50)->comment('議題標題');
            $table->string('status', 10)->index()->comment('議題狀態');
            $table->unsignedTinyInteger('priority')->index()->comment('議題優先度(1:高/2:正常/3:低)');
            $table->string('remark', 255)->nullable()->comment('備注');
            $table->timestamp('created_date')->index()->nullable()->comment('議題開始日期');
            $table->timestamp('due_date')->index()->nullable()->comment('預計完成日期');
            $table->timestamp('completed_date')->index()->nullable()->comment('實際完成日期');
            $table->timestamp('release_date')->index()->nullable()->comment('議題結束日期');
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
