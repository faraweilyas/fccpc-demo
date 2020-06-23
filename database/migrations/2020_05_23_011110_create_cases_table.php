<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('user_id')->nullable()->default(false);
            $table->foreignId('guest_id')->nullable()->default(false);
            $table->string('reference_number')->unique()->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('parties')->nullable();
            $table->string('case_category', 50)->nullable();
            $table->string('case_type', 50)->nullable();
            $table->string('applicant_firm', 255)->nullable();
            $table->string('applicant_first_name', 150)->nullable();
            $table->string('applicant_last_name', 150)->nullable();
            $table->string('applicant_email', 150)->nullable();
            $table->string('applicant_phone_number', 150)->nullable();
            $table->string('applicant_address', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('guest_id')
                ->references('id')
                ->on('guests')
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
        Schema::dropIfExists('cases');
    }
}
