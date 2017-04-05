<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('categorie_id');
            $table->integer('user_id');
            $table->string('title');
            $table->enum('sticky',['0','1'])->default('1');
            $table->integer('views');
            $table->string('answered');
            $table->string('slug');
            $table->string('color');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::drop('discussions');
    }
}
