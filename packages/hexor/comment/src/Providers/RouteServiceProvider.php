<?php

namespace LFPackage\Comment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Check if routes is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config('enabled', false);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if ($this->isEnabled()) {
            $this->mapRoutes('web');
            $this->mapRoutes('api');
        }
    }

    protected function mapRoutes($routeType)
    {
        $prefix = $this->config('prefix');
        $namespace = $this->config('namespace');
        $publishedRoutePath = base_path("routes/comment/{$routeType}.php");
        $builtinRoutePath =  __DIR__."/../Routes/{$routeType}.php";

        $routeFilePath = $publishedRoutePath;

        if (!file_exists($routeFilePath))
            $routeFilePath = $builtinRoutePath;
        Route::prefix($prefix)
             ->namespace($namespace)
             ->group($routeFilePath);
    }

    /**
     * Get config value by key
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function config($key, $default = null)
    {
        $config = $this->app->make('config');

        return $config->get("comment.route.{$key}", $default);
    }

}
