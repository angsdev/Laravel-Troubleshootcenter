<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      // 'App\Models\Model' => 'App\Policies\ModelPolicy',
      'App\Models\Article\Article' => 'App\Policies\Article\ArticlePolicy',
      'App\Models\Article\Comment' => 'App\Policies\Article\CommentPolicy',
      'App\Models\Article\Solution' => 'App\Policies\Article\SolutionPolicy',
      'App\Models\Article\Tag' => 'App\Policies\Article\TagPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){

      $this->registerPolicies();
      Gate::before(fn($user) => $user->isAdmin() ?: null);
    }
}
