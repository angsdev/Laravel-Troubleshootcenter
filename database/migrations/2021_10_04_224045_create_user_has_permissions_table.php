<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasPermissionsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(){

    Schema::create('UserHasPermissions', function(Blueprint $table){

      $table->id();
      $table->foreignId('user_id')->references('id')->on('Users')->onUpdate('no action')->onDelete('cascade');
      $table->foreignId('permission_id')->references('id')->on('Permissions')->onUpdate('no action')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){

    Schema::dropIfExists('UserHasPermissions');
  }
}
