<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('customer_id',191)->after('remember_token')->nullable();
            $table->string('total_invested',191)->after('remember_token')->nullable();
            $table->string('first_name',191)->after('remember_token')->nullable();
            $table->string('last_name',191)->after('remember_token')->nullable();
            $table->string('mobile',191)->after('remember_token')->nullable();
            $table->string('profile_img',191)->after('remember_token')->nullable();
            $table->string('gender',191)->after('remember_token')->nullable();
            $table->string('aadhar_no',191)->after('remember_token')->nullable();
            $table->string('pan_no',191)->after('remember_token')->nullable();
            $table->string('gst_no',191)->after('remember_token')->nullable();
            $table->string('permanent_address',191)->after('remember_token')->nullable();
            $table->string('bank_name',191)->after('remember_token')->nullable();
            $table->string('ifsc_code',191)->after('remember_token')->nullable();
            $table->string('account_no',191)->after('remember_token')->nullable();
            $table->string('cheque_copy',191)->after('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('customer_id');
             $table->dropColumn('total_invested');
             $table->dropColumn('first_name');
             $table->dropColumn('last_name');
             $table->dropColumn('mobile');
             $table->dropColumn('profile_img');
             $table->dropColumn('gender');
             $table->dropColumn('aadhar_no');
             $table->dropColumn('pan_no');
             $table->dropColumn('gst_no');
             $table->dropColumn('permanent_address');
             $table->dropColumn('bank_name');
             $table->dropColumn('ifsc_code');
             $table->dropColumn('account_no');
             $table->dropColumn('cheque_copy');
        });
    }
};
