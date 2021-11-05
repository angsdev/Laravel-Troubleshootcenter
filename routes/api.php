<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\User\Role\RoleController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\Tag\TagController;
use App\Http\Controllers\User\UserArticleController;
use App\Http\Controllers\Article\ArticleTagController;
use App\Http\Controllers\User\UserPermissionController;
use App\Http\Controllers\Article\ArticleCommentController;
use App\Http\Controllers\Article\ArticleSolutionController;
use App\Http\Controllers\User\Role\RolePermissionController;
use App\Http\Controllers\User\Permission\PermissionController;
use App\Http\Controllers\Article\ArticleSolutionVoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function(){

  Route::post('register', [ UserController::class, 'store' ]);
  Route::post('login', [ LoginController::class, 'login' ]);
  Route::post('forgot-password', [ PasswordController::class, 'forgotPassword' ])->name('password.email');
  Route::post('reset-password', [ PasswordController::class, 'resetPassword' ])->name('password.reset');
});

Route::middleware('auth:sanctum')->group(function(){

  Route::get('email/verify/{id}/{hash}', [ EmailController::class, 'verifyEmail' ])->name('verification.verify');
  Route::post('email/verify-notification', [ EmailController::class, 'resendEmailVerification' ]);
  Route::middleware('verified')->group(function(){

    /** User Profile **/
    Route::prefix('profile')->group(function(){

      Route::get('/', [ ProfileController::class, 'index' ]);
      Route::get('roles', [ ProfileController::class, 'roles' ]);
      Route::get('permissions', [ ProfileController::class, 'permissions' ]);
      Route::prefix('articles')->group(function(){

        Route::get('/', [ ProfileController::class, 'articles' ]);
        Route::get('comments', [ ProfileController::class, 'comments' ]);
        Route::get('solutions', [ ProfileController::class, 'solutions' ]);
      });
    });
    /** Resources endpoints **/
    Route::apiResources([
      'users' => UserController::class,
      'users.articles' => UserArticleController::class,
      'roles' => RoleController::class,
      'permissions' => PermissionController::class,
      'articles/tags' =>  TagController::class,
      'articles' => ArticleController::class,
      'articles.comments' => ArticleCommentController::class,
      'articles.solutions' => ArticleSolutionController::class
    ]);
    Route::apiResources([
      'users.roles' => UserRoleController::class,
      'users.permissions' => UserPermissionController::class,
      'roles.permissions' => RolePermissionController::class,
      'articles.tags' => ArticleTagController::class
    ], [ 'except' => 'update' ]);
    Route::match(['put', 'patch'], 'users/{user}/roles', [ UserRoleController::class, 'update' ])->name('users.roles.update');
    Route::match(['put', 'patch'], 'users/{user}/permissions', [ UserPermissionController::class, 'update' ])->name('users.permissions.update');
    Route::match(['put', 'patch'], 'roles/{role}/permissions', [ RolePermissionController::class, 'update' ])->name('roles.permissions.update');
    Route::match(['put', 'patch'], 'articles/{article}/tags', [ ArticleTagController::class, 'update' ])->name('articles.tags.update');
    Route::prefix('articles/{article}/solutions/{solution}/votes')->group(function(){
      Route::get('/', [ ArticleSolutionVoteController::class, 'index' ])->name('articles.solutions.votes.index');
      Route::post('/', [ ArticleSolutionVoteController::class, 'store' ])->name('articles.solutions.votes.update');
      Route::delete('/', [ ArticleSolutionVoteController::class, 'destroy' ])->name('articles.solutions.votes.delete');
    });
  });
  Route::match([ 'post', 'get' ], 'logout', [ LoginController::class, 'logout' ]);
});

Route::fallback(fn() => response()->json(['success' => false, 'message' => 'Resource not found.'], 404));
