<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToChecklistGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklist_groups', function (Blueprint $table) {
            $table->string('category')->after('label')->nullable();
            $table->string('file')->after('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checklist_groups', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('file');
        });
    }
}
