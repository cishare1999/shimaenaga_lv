<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgreementColumnsToUserItems extends Migration
{
    public function up()
    {
        Schema::table('user_items', function (Blueprint $table) {
            $table->string('agreement_signature')->nullable()->after('contract_status');
            $table->dateTime('agreement_signed_at')->nullable()->after('agreement_signature');
            $table->text('agreement_text')->nullable()->after('agreement_signed_at');
            $table->string('agreement_url')->nullable()->after('agreement_text');
        });
    }

    public function down()
    {
        Schema::table('user_items', function (Blueprint $table) {
            $table->dropColumn([
                'agreement_signature',
                'agreement_signed_at',
                'agreement_text',
                'agreement_url',
            ]);
        });
    }
}