<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('checklist_groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklists');
    }
}