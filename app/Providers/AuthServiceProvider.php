<?php

namespace App\Providers;

use App\Question;
use App\Policies\QuestionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    //     Gate::define('update-post', function ($user, $question) {
    //          return $user->id == $question->user_id;
    //       });
    //    Gate::define('delete-post', function ($user, $question) {
    //         return $user->id == $question->user_id;
    //      });
    }
}
