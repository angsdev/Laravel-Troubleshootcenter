<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use App\Traits\ModelHelpers;
use App\Traits\PermissionHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model {

  use ModelHelpers, PermissionHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Roles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description'
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
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'permissions'
  ];

  /**
   * Get users associated with the role.
   *
   * @return belongsToMany
   */
  public function users(){

    return $this->belongsToMany(User::class, 'UserHasRoles');
  }

  /**
   * Get permissions associated with the role.
   *
   * @return belongsToMany
   */
  public function permissions(){

    return $this->belongsToMany(Permission::class, 'RoleHasPermissions');
  }
}
