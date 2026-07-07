<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('kana')->nullable();
            $table->string('line')->nullable();
            $table->string('contact')->nullable();
            $table->string('zip')->nullable();
            $table->string('pref')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('building')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('bank_type')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_kana')->nullable();
            $table->string('licence_1')->nullable();
            $table->string('licence_2')->nullable();
            $table->string('licence_3')->nullable();
            $table->string('work_name')->nullable();
            $table->string('work_tel')->nullable();
            $table->string('work_zip')->nullable();
            $table->string('work_pref')->nullable();
            $table->string('work_city')->nullable();
            $table->string('work_address')->nullable();
            $table->string('work_building')->nullable();
            $table->string('salary')->nullable();
            $table->string('payday')->nullable();
            $table->text('memo')->nullable();
            $table->string('is_black')->nullable();
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
        Schema::dropIfExists('user_data');
    }
}
