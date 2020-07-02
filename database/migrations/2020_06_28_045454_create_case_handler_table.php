<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseHandlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_handler', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('handler_id');
            $table->timestamp('defficiency_issued_at')->nullable();
            $table->text('defficiency')->nullable();
            $table->timestamp('recommendation_issued_at')->nullable();
            $table->text('recommendation')->nullable();
            $table->timestamp('approval_requested_at')->nullable();
            $table->string('approval_status', 20)->nullable();
            $table->timestamp('extension_requested_at')->nullable();
            $table->string('extension_reason')->nullable();
            $table->timestamp('dropped_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->unique(['supervisor_id', 'case_id', 'handler_id']);

            $table->foreign('supervisor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('case_id')
                ->references('id')
                ->on('cases')
                ->onDelete('cascade');
            $table->foreign('handler_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('case_handler');
    }
}
