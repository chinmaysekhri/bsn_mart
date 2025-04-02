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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('created_by')->nullable();
			$table->string('date_of_joining',50)->nullable();
			$table->string('managed_by',50)->nullable();
			$table->string('designation',50)->nullable();
			$table->string('first_name',50)->nullable();
			$table->string('last_name',50)->nullable();
			$table->string('mobile',50)->nullable();
			$table->string('email')->unique();
			$table->string('gender',50)->nullable();
			$table->string('salary',50)->nullable();
			$table->string('resume',191)->nullable();
			$table->string('esi_no',50)->nullable();
			$table->string('present_address',191)->nullable();
			$table->string('permanent_address',191)->nullable();
			$table->string('aadhar_no',100)->nullable();
			$table->string('pan_no',100)->nullable();
			$table->string('uan_no',100)->nullable();
			$table->string('qualification',100)->nullable();
			$table->string('ten_passing_year',100)->nullable();
			$table->string('ten_mark_percentage',100)->nullable();
			$table->string('ten_board_school',100)->nullable();
			$table->string('ten_board_school_document',100)->nullable();
			$table->string('twelve_passing_year',100)->nullable();
			$table->string('twelve_mark_percentage',100)->nullable();
			$table->string('twelve_board_school',100)->nullable();
			$table->string('twelve_board_school_document',100)->nullable();
			$table->string('graduate_passing_year',100)->nullable();
			$table->string('graduate_mark_percentage',100)->nullable();
			$table->string('graduate_board_school',100)->nullable();
			$table->string('graduate_board_school_document',100)->nullable();
			$table->string('post_graduate_passing_year',100)->nullable();
			$table->string('post_graduate_mark_percentage',100)->nullable();
			$table->string('post_graduate_board_school',100)->nullable();
			$table->string('post_graduate_board_school_document',100)->nullable();
			$table->string('phd_passing_year',100)->nullable();
			$table->string('phd_mark_percentage',100)->nullable();
			$table->string('phd_board_school',100)->nullable();
			$table->string('phd_board_school_document',100)->nullable();
			$table->string('company_name',100)->nullable();
			$table->string('from_company_duration',100)->nullable();
			$table->string('to_company_duration',100)->nullable();
			$table->string('company_ctc',100)->nullable();
			$table->string('company_offer_letter',100)->nullable();
			$table->string('company_relieving_letter',100)->nullable();
			$table->string('salary_slip_first',100)->nullable();
			$table->string('salary_slip_second',100)->nullable();
			$table->string('salary_slip_third',100)->nullable();
			$table->string('other_company_name',100)->nullable();
			$table->string('other_from_duration',100)->nullable();
			$table->string('other_to_duration',100)->nullable();
			$table->string('other_company_ctc',100)->nullable();
			$table->string('other_offer_letter',100)->nullable();
			$table->string('other_relieving_letter',100)->nullable();
			$table->string('other_company_offer_letter',100)->nullable();
			$table->string('other_document_name',100)->nullable();
			$table->string('other_upload_document',100)->nullable();
			$table->string('comment',100)->nullable();
			$table->string('status')->default(0);
            $table->timestamps();
			$table->softDeletes();
			
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
