<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLineColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(true)->change();
            $table->string('password')->nullable(true)->change();
            $table->string('line_id')->nullable()->comment('LINEのID')->after('from_url');
            $table->string('mode')->nullable()->comment('チャネルの状態')->after('line_id'); // `standby` は送信すべきでない
            $table->string('display_name')->nullable()->comment('LINEの名前')->after('mode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->dropColumn('line_id');
            $table->dropColumn('mode');
            $table->dropColumn('display_name');
        });
    }
}
