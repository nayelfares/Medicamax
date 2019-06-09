<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDifferentialDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('differential_diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('code');
            $table->text('en_term');
            $table->integer('level')->nullable(); //diseases_level
            $table->text('ar_term')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('parent_code')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->text('en_note')->nullable();//note
            $table->text('ar_note')->nullable();
            $table->text('s_ar_term')->default(null);
            $table->string('text_color')->default("000000");
            $table->string('background_color')->default("ffffff");
            $table->string('bold')->default("normal");
            $table->string('italic')->default("normal");
            $table->string('under_line')->default("none");
            $table->integer('ar_size')->default(18);
            $table->integer('en_size')->default(16);
            $table->boolean('show_code');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('differential_diagnoses', function (Blueprint $table){            
            $table->foreign('parent_id')->references('id')->on('differential_diagnoses')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('differential_diagnoses');
    }
}
