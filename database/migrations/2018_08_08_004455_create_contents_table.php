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
            $table->unsignedInteger('contentable_id')->index()->comment('多態ID關聯');
            $table->string('contentable_type', 30)->index()->comment('多態模型關聯');
            $table->text('content_body')->nullable()->comment('內容');
            $table->string('remark', 255)->nullable()->comment('備注');
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
