<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('comments')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('shares')->default(0);
            $table->string('ipaddress')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();


            $table->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('posts');
    }
}
