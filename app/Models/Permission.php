<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Permissions';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'pivot',
  ];

  /**
   * Get users associated with the permission.
   *
   * @return belongsToMany
   */
  public function users(){

    return $this->belongsToMany(User::class, 'UserHasPermissions');
  }

  /**
   * Get roles associated with the permission.
   *
   * @return belongsToMany
   */
  public function roles(){

    return $this->belongsToMany(Role::class, 'RoleHasPermissions');
  }
}
