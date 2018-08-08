<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id')->index()->comment('議題 ID 或 專案 ID 關聯');
            $table->string('file_type', 30)->index()->comment('關聯的模型');
            $table->string('file_name', 50)->index()->comment('檔案 名稱');
            $table->text('file_path')->nullable()->comment('檔案 Path');
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
        Schema::dropIfExists('files');
    }
}
