<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCouncilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_council', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('msv');
            $table->longtext('topic');
            $table->integer('id_topic');
            $table->longtext('lecturer');
            $table->interger('id_lecturer');
            $table->string('id_council');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_council');
    }
}
