<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForm1ATextColumnInCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('form_1A_Text');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->text('form_1A_Text')->after('letter_of_appointment')->nullable();
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
            $table->dropColumn('form_1A_Text');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->string('form_1A_Text')->after('letter_of_appointment')->nullable();
        });
    }
}
