<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeesColumnsToCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->string('application_fee')->after('form_1A_Date')->nullable();
            $table->string('processing_fee')->after('application_fee')->nullable();
            $table->string('expedited_fee')->after('processing_fee')->nullable();
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
            $table->dropColumn('application_fee');
            $table->dropColumn('processing_fee');
            $table->dropColumn('expedited_fee');
        });
    }
}
