<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefficiencyColumnToCaseHandlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_handler', function (Blueprint $table) {
            $table->text('defficiency')->after('defficiency_issued_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('defficiency');
        });
    }
}
