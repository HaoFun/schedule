<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('content_id')->index()->comment('議題 ID 或 專案 ID 關聯');
            $table->string('content_type', 30)->index()->comment('關聯的模型');
            $table->text('content')->nullable()->comment('內容');
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
        Schema::dropIfExists('contents');
    }
}
