<?php

declare(strict_types=1);

namespace Modules\Post\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Post\Contracts\Services\PostServiceInterface;
use Modules\Post\Services\V1\PostService;

class PostServiceProvider extends ServiceProvider
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
        $this->app->bind(PostServiceInterface::class, PostService::class);
    }


    /**
     * Register model observers
     */
    private function registerObservers(): void
    {

    }
}
