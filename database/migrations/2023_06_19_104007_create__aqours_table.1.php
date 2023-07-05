<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aqours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('live_title');
            $table->string('venue');
            $table->string('day');
            $table->date('date');
            $table->string('song_title', 9999)->nullable(); // 曲名カラムの追加（nullable）
            $table->string('memo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aqours');
    }

};
