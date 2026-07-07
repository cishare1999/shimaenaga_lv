<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendmessages', function (Blueprint $table) {
            $table->id();
            $table->string('send_status')->nullable()->comment('状態');
            $table->string('send_title')->nullable()->comment('タイトル');
            $table->text('sentence')->nullable()->comment('文章');
            $table->string('memo01')->nullable()->comment('メモ1');
            $table->string('memo02')->nullable()->comment('メモ2');
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
        Schema::dropIfExists('sendmessages');
    }
}
