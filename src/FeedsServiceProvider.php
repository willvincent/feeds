<?php namespace willvincent\Feeds;

use Illuminate\Support\ServiceProvider;
use willvincent\Feeds\FeedsFactory;

class FeedsServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = true;

  public function boot() {
    $this->publishes([
      __DIR__ . '/config/feeds.php' => config_path('feeds.php'),
    ]);
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    $this->app['Feeds'] = $this->app->share(function($app) {
      $config = config('feeds');

      if (!$config) {
        throw new \RunTimeException('Feeds configuration not found. Please run `php artisan vendor:publish`');
      }

      return new FeedsFactory($config);
    });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
    return ['Feeds'];
  }

}
