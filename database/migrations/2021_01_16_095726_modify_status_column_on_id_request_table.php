<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnOnIdRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('id_request', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('id_request', function (Blueprint $table) {
            $table->boolean('status')->default(false)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_request', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('id_request', function (Blueprint $table) {
            $table->boolean('status')->defalut(false)->after('type');
        });
    }
}
