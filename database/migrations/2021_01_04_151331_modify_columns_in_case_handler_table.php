<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsInCaseHandlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('recommendation');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->text('recommendation')->after('recommendation_issued_at')->nullable();
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('approval_comment');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->text('approval_comment')->after('approval_status')->nullable();
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('extension_reason');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->text('extension_reason')->after('extension_requested_at')->nullable();
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
            $table->dropColumn('recommendation');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->string('recommendation')->after('recommendation_issued_at')->nullable();
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('approval_comment');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->string('approval_comment')->after('approval_status')->nullable();
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->dropColumn('extension_reason');
        });

        Schema::table('case_handler', function (Blueprint $table) {
            $table->string('extension_reason')->after('extension_requested_at')->nullable();
        });
    }
}
