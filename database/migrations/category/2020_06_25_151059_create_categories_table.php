<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');


            $table->string('slug');
            $table->boolean('main_bar')->default(0);
            $table->string('title');
            $table->string('meta_keys')->nullable();

            $table->text('description');
            $table->string('image')->nullable();


            // Foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
