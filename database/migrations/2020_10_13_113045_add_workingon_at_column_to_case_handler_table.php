<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkingonAtColumnToCaseHandlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_handler', function (Blueprint $table) {
            $table->timestamp('workingon_at')->nullable()->after('handler_id');
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
            $table->dropColumn('workingon_at');
        });
    }
}
