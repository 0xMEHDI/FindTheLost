<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRequestsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('item_requests', function (Blueprint $table)
    {
      $table->increments('id');

      //Info available to registered users
      $table->string('item_name');
      $table->text('request_text');
      $table->enum('approval_status', ['Pending', 'Approved', 'Denied']);

      //Info available to administrators
      $table->unsignedBigInteger('user_id');
      $table->string('user_name')->nullable();
      $table->unsignedBigInteger('item_id');
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('user_name')->references('name')->on('users');
      $table->foreign('item_id')->references('id')->on('items');

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
    Schema::dropIfExists('item_requests');
  }
}
