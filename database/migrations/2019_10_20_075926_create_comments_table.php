<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->longText('content')->nullable();
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('replies')->default(0);
            $table->bigInteger('shares')->default(0);
            $table->string('ipaddress')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();


            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');


            $table->foreign('post_id')
                    ->references('id')->on('posts')
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
        Schema::dropIfExists('comments');
    }
}
