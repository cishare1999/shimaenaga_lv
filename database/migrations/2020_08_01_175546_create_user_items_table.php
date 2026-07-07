<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_items', function (Blueprint $table) {
            $table->id();

            $table->string('user_id');
            $table->string('way')->nullable();
            $table->string('item_name')->nullable();
            $table->string('condition')->nullable();
            $table->string('comment')->nullable();
            $table->string('price')->nullable();
            $table->string('price_more')->nullable();
            $table->string('item_image1')->nullable();
            $table->string('item_image2')->nullable();
            $table->string('item_image3')->nullable();
            $table->string('status_judge')->nullable();
            $table->string('status_payment')->nullable();
            $table->string('status_item')->nullable();
            $table->string('status_total')->nullable();
            $table->string('status_paid')->nullable();
            $table->string('judge_price')->nullable();
            $table->string('user_agree')->nullable();
            $table->string('memo')->nullable();
            $table->string('for_user')->nullable();

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
        Schema::dropIfExists('user_items');
    }
}
