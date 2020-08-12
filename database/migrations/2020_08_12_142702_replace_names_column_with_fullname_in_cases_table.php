<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplaceNamesColumnWithFullnameInCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('applicant_first_name');
            $table->dropColumn('applicant_last_name');
            $table->string('applicant_fullname', 150)->nullable()->after('applicant_firm');
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
            $table->string('applicant_first_name', 150)->nullable()->after('applicant_firm');
            $table->string('applicant_last_name', 150)->nullable()->after('applicant_first_name');
        });
    }
}
