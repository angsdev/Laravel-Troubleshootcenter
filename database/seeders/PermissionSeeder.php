<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){

    Permission::factory()->createMany([
      // Users
      [
        'name' => 'view any user',
        'description' => 'Permission that allow see any user.'
      ],
      [
        'name' => 'view user',
        'description' => 'Permission that allow see own user.'
      ],
      [
        'name' => 'create user',
        'description' => 'Permission that allow create an user.'
      ],
      [
        'name' => 'update any user',
        'description' => 'Permission that allow update any user.'
      ],
      [
        'name' => 'update user',
        'description' => 'Permission that allow update own view.'
      ],
      [
        'name' => 'delete any user',
        'description' => 'Permission that allow delete any user.'
      ],
      [
        'name' => 'delete user',
        'description' => 'Permission that allow delete own user.'
      ],
      // Roles
      [
        'name' => 'view any role',
        'description' => 'Permission that allow see any role.'
      ],
      [
        'name' => 'view role',
        'description' => 'Permission that allow see own role.'
      ],
      [
        'name' => 'create role',
        'description' => 'Permission that allow create role.'
      ],
      [
        'name' => 'update role',
        'description' => 'Permission that allow update role.'
      ],
      [
        'name' => 'delete role',
        'description' => 'Permission that allow delete role.'
      ],
      // Permissions
      [
        'name' => 'view any permission',
        'description' => 'Permission that allow see any permission.'
      ],
      [
        'name' => 'view permission',
        'description' => 'Permission that allow see own permission.'
      ],
      [
        'name' => 'create permission',
        'description' => 'Permission that allow create permission.'
      ],
      [
        'name' => 'update permission',
        'description' => 'Permission that allow update permission.'
      ],
      [
        'name' => 'delete permission',
        'description' => 'Permission that allow delete permission.'
      ],
      // Articles
      [
        'name' => 'view any article',
        'description' => 'Permission that allow see any article.'
      ],
      [
        'name' => 'view article',
        'description' => 'Permission that allow see own article.'
      ],
      [
        'name' => 'create article',
        'description' => 'Permission that allow create article.'
      ],
      [
        'name' => 'update any article',
        'description' => 'Permission that allow update any article.'
      ],
      [
        'name' => 'update article',
        'description' => 'Permission that allow update article.'
      ],
      [
        'name' => 'delete any article',
        'description' => 'Permission that allow delete any article.'
      ],
      [
        'name' => 'delete article',
        'description' => 'Permission that allow delete article.'
      ],
      // Article Comments
      [
        'name' => 'view any article comment',
        'description' => 'Permission that allow see any comment.'
      ],
      [
        'name' => 'view article comment',
        'description' => 'Permission that allow see comment.'
      ],
      [
        'name' => 'create article comment',
        'description' => 'Permission that allow create comment.'
      ],
      [
        'name' => 'update any article comment',
        'description' => 'Permission that allow update any comment.'
      ],
      [
        'name' => 'update article comment',
        'description' => 'Permission that allow update comment.'
      ],
      [
        'name' => 'delete any article comment',
        'description' => 'Permission that allow delete any comment.'
      ],
      [
        'name' => 'delete article comment',
        'description' => 'Permission that allow delete comment.'
      ],
      // Article Solutions
      [
        'name' => 'view any article solution',
        'description' => 'Permission that allow see anysolution.'
      ],
      [
        'name' => 'view article solution',
        'description' => 'Permission that allow see solution.'
      ],
      [
        'name' => 'create article solution',
        'description' => 'Permission that allow create solution.'
      ],
      [
        'name' => 'update any article solution',
        'description' => 'Permission that allow update any solution.'
      ],
      [
        'name' => 'update article solution',
        'description' => 'Permission that allow update solution.'
      ],
      [
        'name' => 'delete any article solution',
        'description' => 'Permission that allow delete any solution.'
      ],
      [
        'name' => 'delete article solution',
        'description' => 'Permission that allow delete solution.'
      ],
      // Article tags
      [
        'name' => 'view any article tag',
        'description' => 'Permission that allow see any tag.'
      ],
      [
        'name' => 'view article tag',
        'description' => 'Permission that allow see tag.'
      ],
      [
        'name' => 'create article tag',
        'description' => 'Permission that allow create tag.'
      ],
      [
        'name' => 'update article tag',
        'description' => 'Permission that allow update tag.'
      ],
      [
        'name' => 'delete article tag',
        'description' => 'Permission that allow delete tag.'
      ]
    ]);
  }
}
