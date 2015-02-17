<?php namespace willvincent\Feeds;

use SimplePie;

class FeedsFactory {

  protected $config;

  protected $simplepie;

  /**
   * @param $config
   */
  public function __construct($config) {
    $this->config = $config;
  }

  public function make($feed_url) {
    $this->simplepie = new SimplePie();
    $this->configure();
    $this->simplepie->set_feed_url($feed_url);
    $this->simplepie->init();
    $this->simplepie->handle_content_type();

    return $this->simplepie;
  }

  protected function configure() {
    if ($this->config['cache.disabled']) {
      $this->simplepie->enable_cache(false);
    }
    else {
      $this->simplepie->set_cache_location($this->config['cache.location']);
      $this->simplepie->set_cache_duration($this->config['cache.life']);
    }
  }
}
