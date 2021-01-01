<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifiedForm1AColumnInCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('form_1A');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->mediumText('form_1A_Text')->after('letter_of_appointment')->nullable();
            $table->string('form_1A_Name')->after('form_1A_Text')->nullable();
            $table->string('form_1A_Date')->after('form_1A_Name')->nullable();
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
             $table->string('form_1A')->after('letter_of_appointment')->nullable();
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('form_1A_Text');
            $table->dropColumn('form_1A_Name');
            $table->dropColumn('form_1A_Date');
        });
    }
}
