<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('關聯User模型');
            $table->boolean('is_done')->index()->default(0)->comment('是否完成');
            $table->string('todo', 255)->comment('代辦事項');
            $table->timestamp('start_date')->nullable()->index()->comment('代辦事項開始時間');
            $table->timestamp('due_date')->nullable()->index()->comment('代辦事項需完成時間');
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
        Schema::dropIfExists('todos');
    }
}
