<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractColumnToUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_items', function (Blueprint $table) {
            //
            $table->string('contract_name')->nullable()->after('for_user');
            $table->string('contract_price')->nullable()->after('contract_name');
            $table->string('contract_cancel')->nullable()->after('contract_price');
            $table->string('contract_repayment_date')->nullable()->after('contract_cancel');
            $table->string('contract_deadline_date')->nullable()->after('contract_repayment_date');
            $table->string('contract_issu_date')->nullable()->after('contract_deadline_date');
            $table->string('contract_status')->nullable()->after('contract_issu_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_items', function (Blueprint $table) {
            //
            $table->dropColumn('contract_name');
            $table->dropColumn('contract_price');
            $table->dropColumn('contract_cancel');
            $table->dropColumn('contract_repayment_date');
            $table->dropColumn('contract_deadline_date');
            $table->dropColumn('contract_issu_date');
            $table->dropColumn('contract_status');
        });
    }
}
