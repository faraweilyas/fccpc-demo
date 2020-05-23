<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('parties', 100)->nullable();
            $table->string('case_rep', 50)->nullable();
            $table->string('transaction_type', 50)->nullable();
            $table->string('transaction_category', 50)->nullable();
            $table->string('applicant_firm', 150)->nullable();
            $table->string('applicant_first_name', 150)->nullable();
            $table->string('applicant_last_name', 150)->nullable();
            $table->string('applicant_email', 150)->nullable();
            $table->string('applicant_phone_no', 150)->nullable();
            $table->string('applicant_address', 150)->nullable();
            $table->mediumText('applicant_company_documents')->nullable();
            $table->mediumText('applicant_account_documents')->nullable();
            $table->mediumText('applicant_payment_documents')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('case_handler_id')->nullable();
            $table->string('recommendation', 225)->nullable();
            $table->string('comments', 225)->nullable();
            $table->integer('request_id')->nullable();
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
        Schema::dropIfExists('cases');
    }
}
