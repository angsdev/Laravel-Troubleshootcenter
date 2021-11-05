<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){

    Role::factory()->create([
      'name' => 'administrator',
      'description' => 'Role that can manage everything.'
    ])->givePermissionTo(
      Permission::all('id')
      ->map(fn($v) => $v['id'])
      ->toArray()
    );

    Role::factory()->create([
      'name' => 'customer',
      'description' => 'Role that can only view information related with him.'
    ])->givePermissionTo([
      'view user', 'view role', 'view permission',
      'view any article', 'view tags', 'view any comment',
      'view any solution'
    ]);
  }
}
