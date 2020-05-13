<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicProtectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_protection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_student");// id sv
            $table->integer("id_topic"); // id de tai
            $table->integer("id_protection")->null(); // id dot bao ve
            $table->integer("acceptance")->default('0');
            $table->integer("pass")->null();
            $table->integer("scores")->null();
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
        Schema::dropIfExists('topic_protection');
    }
}
