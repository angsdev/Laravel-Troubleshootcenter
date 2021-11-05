<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

      Schema::create('RoleHasPermissions', function(Blueprint $table){

        $table->id();
        $table->foreignId('role_id')->references('id')->on('Roles')->onUpdate('no action')->onDelete('cascade');
        $table->foreignId('permission_id')->references('id')->on('Permissions')->onUpdate('no action')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

      Schema::dropIfExists('RoleHasPermissions');
    }
}
