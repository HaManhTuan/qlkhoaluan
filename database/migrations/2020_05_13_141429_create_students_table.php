<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string("msv",10)->unique();
            $table->string("name");
            $table->string("phone");
            $table->string("password");
            $table->string("email");
            $table->integer("status")->default('0');
            $table->integer("id_department")->unsigned()->index(); //khoa
            $table->integer("id_classes")->unsigned()->index(); //lop
            $table->integer("id_branch")->unsigned()->index(); //khoa
            $table->foreign('id_department')
                ->references('id')->on('department')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_classes')
                ->references('id')->on('classes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                 $table->foreign('id_branch')
                ->references('id')->on('branches')
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
        Schema::dropIfExists('students');
    }
}
