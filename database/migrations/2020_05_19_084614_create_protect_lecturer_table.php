<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtectLecturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protect_lecturer', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('name_council');
            $table->integer('id_protect')->unsigned()->index();
            $table->integer('id_lecture')->unsigned()->index();
            $table->integer('position');
            $table->integer('id_council');
            $table->foreign('id_protect')
                ->references('id')->on('protections')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_lecture')
                ->references('id')->on('lecturers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('protect_lecturer');
    }
}
