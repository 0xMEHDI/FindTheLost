<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('items', function (Blueprint $table)
    {
      $table->increments('id');

      //Info available to all users
      $table->string('name');
      $table->enum('category', ['Pet', 'Phone', 'Jewellery', 'Other']);
      $table->string('colour', 256);
      $table->dateTime('time_found', 0);

      //Info available to registered users
      $table->string('place_found', 256)->nullable();
      $table->text('description')->nullable();
      $table->string('image', 256)->nullable();

      //Info available to administrators
      $table->unsignedBigInteger('user_id')->nullable();
      $table->string('user_name')->nullable();
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('user_name')->references('name')->on('users');

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
    Schema::dropIfExists('items');
  }
}
