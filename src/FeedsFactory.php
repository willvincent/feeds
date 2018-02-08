<?php namespace willvincent\Feeds;

use SimplePie;

class FeedsFactory
{

    protected $config;

    protected $simplepie;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param array $feed_url RSS URL
     * @param int $limit items returned per-feed with multifeeds
     * @param bool|false $force_feed
     *
     * @return SimplePie
     */
    public function make($feed_url = [], $limit = 0, $force_feed = false, $options = null)
    {
        $this->simplepie = new SimplePie();
        $this->configure();
        $this->simplepie->set_feed_url($feed_url);
        $this->simplepie->set_item_limit($limit);
        if ($force_feed === true) {
            $this->simplepie->force_feed(true);
        }
        if (!$this->config['strip_html_tags.disabled'] && !empty($this->config['strip_html_tags.tags']) && is_array($this->config['strip_html_tags.tags'])) {
            $this->simplepie->strip_htmltags($this->config['strip_html_tags.tags']);
        } else {
            $this->simplepie->strip_htmltags(false);
        }
        if (!$this->config['strip_attribute.disabled'] && !empty($this->config['strip_attribute.tags']) && is_array($this->config['strip_attribute.tags'])) {
            $this->simplepie->strip_attributes($this->config['strip_attribute.tags']);
        } else {
            $this->simplepie->strip_attributes(false);
        }
        if (isset($options) && is_array($options)) {
            if (isset($options['curl.options']) && is_array($options['curl.options'])) {
                $this->simplepie->set_curl_options($this->simplepie->curl_options + $options['curl.options']);
            }
            if (isset($options['strip_html_tags.tags']) && is_array($options['strip_html_tags.tags'])) {
                $this->simplepie->strip_htmltags($options['strip_html_tags.tags']);
            }
            if (isset($options['strip_attribute.tags']) && is_array($options['strip_attribute.tags'])) {
                $this->simplepie->strip_attributes($options['strip_attribute.tags']);
            }
        }
        $this->simplepie->init();
        $this->simplepie->handle_content_type();

        return $this->simplepie;
    }

    protected function configure()
    {
        $curloptions = null;
        if ($this->config['cache.disabled']) {
            $this->simplepie->enable_cache(false);
        } else {
            $this->simplepie->set_cache_location($this->config['cache.location']);
            $this->simplepie->set_cache_duration($this->config['cache.life']);
        }
        if (isset($this->config['curl.options']) && is_array($this->config['curl.options'])) {
            $curloptions[] = $this->config['curl.options'];
        }
        if ($this->config['ssl_check.disabled']) {
            $curloptions[CURLOPT_SSL_VERIFYHOST] = false;
            $curloptions[CURLOPT_SSL_VERIFYPEER] = false;
        }
        if (is_array($curloptions)) {
            $this->simplepie->set_curl_options($curloptions);
        }
    }
}
