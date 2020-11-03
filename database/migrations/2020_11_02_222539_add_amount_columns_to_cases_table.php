<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountColumnsToCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->string('combined_turnover')->after('applicant_address')->nullable();
            $table->string('filling_fee')->after('combined_turnover')->nullable();
            $table->string('expedited_fee')->after('filling_fee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('combined_turnover');
            $table->dropColumn('filling_fee');
            $table->dropColumn('expedited_fee');
        });
    }
}
