<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteAdsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_ad_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('套餐名称');
            $table->text('desc')->nullable()->comment('套餐介绍');
            $table->unsignedInteger('count')->default(1)->comment('次数|时长');
            $table->unsignedTinyInteger('unit')->default(0)->comment('计算单位');
            $table->unsignedDecimal('amount')->default(0)->comment('价格');
            $table->unsignedBigInteger('currency_type_id')->default(0)->comment('支付类型ID');
            $table->boolean('status')->default(1)->comment('状态');
            $table->timestamps();
        });

        Schema::create('site_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_ad_package_id')->index()->comment('选择套餐');
            $table->unsignedBigInteger('user_id')->index()->comment('会员');
            $table->morphs('moduleable');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
            $table->unsignedInteger('uv')->default(0)->comment('点击数');
            $table->unsignedInteger('pv')->default(0)->comment('展现数');
            $table->timestamps();
        });

        Schema::create('site_ad_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_ad_id')->index()->comment('广告');
            $table->unsignedBigInteger('user_id')->default(0)->index()->comment('会员');
            $table->ipAddress('ip')->nullable()->comment('IP');
            $table->string('province', 55)->nullable()->comment('省');
            $table->string('city', 55)->nullable()->comment('市');
            $table->string('district', 55)->nullable()->comment('区');
            $table->string('device', 55)->nullable()->comment('设备');
            $table->string('browse', 55)->nullable()->comment('浏览器');
            $table->string('system', 55)->nullable()->comment('系统');
            $table->string('net_type', 10)->nullable()->comment('网络');
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
        Schema::dropIfExists('site_ad_packages');
        Schema::dropIfExists('site_ads');
        Schema::dropIfExists('site_ad_logs');
    }
}
