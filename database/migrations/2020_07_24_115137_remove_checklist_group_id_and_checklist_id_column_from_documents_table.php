<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveChecklistGroupIdAndChecklistIdColumnFromDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['checklist_group_id']);
            $table->dropForeign(['checklist_id']);
            $table->dropColumn('checklist_group_id');
            $table->dropColumn('checklist_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('checklist_group_id')->after('case_id');
            $table->foreignId('checklist_id')->after('checklist_group_id');
        });

        $table->foreign('checklist_group_id')
                ->references('id')
                ->on('checklist_groups')
                ->onDelete('cascade');

        $table->foreign('checklist_id')
            ->references('id')
            ->on('checklists')
            ->onDelete('cascade');
    }
}
