<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAdditionalInfoColumnInDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('additional_info');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->text('additional_info')->after('file')->nullable();
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
            $table->dropColumn('additional_info');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->string('additional_info')->after('file')->nullable();
        });
    }
}
