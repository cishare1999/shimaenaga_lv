<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLicenceEtcToUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_data', function (Blueprint $table) {
            //
            $table->string('birthday')->nullable()->after('kana');
            $table->string('gender')->nullable()->after('birthday');
            $table->string('licence_4')->nullable()->after('licence_3');
            $table->string('licence_5')->nullable()->after('licence_4');
            $table->string('licence_6')->nullable()->after('licence_5');
            $table->string('licence_7')->nullable()->after('licence_6');
            $table->string('licence_8')->nullable()->after('licence_7');
            $table->string('licence_9')->nullable()->after('licence_8');
            $table->string('licence_10')->nullable()->after('licence_9');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_data', function (Blueprint $table) {
            //
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('licence_4');
            $table->dropColumn('licence_5');
            $table->dropColumn('licence_6');
            $table->dropColumn('licence_7');
            $table->dropColumn('licence_8');
            $table->dropColumn('licence_9');
            $table->dropColumn('licence_10');
        });
    }
}
