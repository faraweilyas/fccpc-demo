<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalIssuedAtToCaseHandlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_handler', function (Blueprint $table) {
            $table->timestamp('checklist_approval_issued_at')->after('defficiency_issued_at')->nullable();
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
            $table->dropColumn('checklist_approval_issued_at');
        });
    }
}
