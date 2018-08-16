<?php

namespace App\Providers;

use App\Models\Issue;
use App\Models\Project;
use App\Observers\IssueObserver;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'projects' => 'App\Models\Project',
            'issues' => 'App\Models\Issue',
            'contents' => 'App\Models\Content',
        ]);
        Project::observe(ProjectObserver::class);
        Issue::observe(IssueObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
