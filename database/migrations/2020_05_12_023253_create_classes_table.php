<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('department_id')->unsigned()->index();
            $table->integer('branch_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('department_id')
                ->references('id')->on('department')
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
        Schema::dropIfExists('classes');
    }
}
