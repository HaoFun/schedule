<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 30)->unique()->index()->comment('帳號');
            $table->string('name', 30)->comment('姓名');
            $table->string('email')->unique()->comment('信箱');
            $table->unsignedInteger('department_id')->comment('使用者角色(1:管理部/2:專案部/3:研究部/4:編輯部/5:設計部/6:工程部/7:其他)');
            $table->string('language', 10)->default('zh_TW')->comment('語系');
            $table->string('password')->comment('密碼');
            $table->boolean('status')->default(1)->comment('狀態(0:停用/1:啟用)');
            $table->string('api_token', 64)->comment('對外Api_token存取金鑰');
            $table->timestamp('password_changed_at')->nullable()->comment('上次密碼變更日期');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
