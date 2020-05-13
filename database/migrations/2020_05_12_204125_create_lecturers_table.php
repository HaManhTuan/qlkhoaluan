<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name_lecturer");
            $table->string("address_lecturer");
            $table->string("email_address_lecturer")->unique();
            $table->string("phone_number");
            $table->string('password');
            $table->integer('status')->default('0');
            $table->integer("id_department"); //khoa
            $table->integer("id_field");// ma linh vuc huong dan
            $table->timestamps();
            $table->foreign('id_department')
                ->references('id')->on('department')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_field')
                ->references('id')->on('fields')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('lecturers');
    }
}
