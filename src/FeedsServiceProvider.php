<?php namespace willvincent\Feeds;

use Illuminate\Support\ServiceProvider;

class FeedsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/feeds.php' => config_path('feeds.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FeedsFactory::class, function () {
            $config = config('feeds');

            if (! $config) {
                throw new \RunTimeException('Feeds configuration not found. Please run `php artisan vendor:publish`');
            }

            return new FeedsFactory($config);
        });
        $this->app->alias(FeedsFactory::class, 'Feeds');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Feeds'];
    }
}
