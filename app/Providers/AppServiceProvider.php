<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\Department;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tracker;
use App\Models\Type;
use App\Models\User;
use App\Observers\ContentObserver;
use App\Observers\DepartmentObserver;
use App\Observers\IssueObserver;
use App\Observers\ProjectObserver;
use App\Observers\TrackerObserver;
use App\Observers\TypeObserver;
use App\Observers\UserObserver;
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
        Content::observe(ContentObserver::class);
        User::observe(UserObserver::class);
        Department::observe(DepartmentObserver::class);
        Tracker::observe(TrackerObserver::class);
        Type::observe(TypeObserver::class);
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
