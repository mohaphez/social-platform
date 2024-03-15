<?php

declare(strict_types=1);

namespace Modules\Comment\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Comment\Contracts\Services\CommentServiceInterface;
use Modules\Comment\Services\V1\CommentService;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerServices();
        $this->registerObservers();
    }

    /**
     * Register module services.
     *
     * @return void
     */
    private function registerServices(): void
    {
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }


    /**
     * Register model observers
     */
    private function registerObservers(): void
    {

    }
}
