<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId('case_id');
            $table->foreignId('checklist_group_id');
            $table->foreignId('checklist_id');
            $table->string('file');
            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->unique(['case_id', 'checklist_group_id', 'checklist_id']);

            $table->foreign('case_id')
                ->references('id')
                ->on('cases')
                ->onDelete('cascade');

            $table->foreign('checklist_group_id')
                ->references('id')
                ->on('checklist_groups')
                ->onDelete('cascade');

            $table->foreign('checklist_id')
                ->references('id')
                ->on('checklists')
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
        Schema::dropIfExists('documents');
    }
}
