<?php namespace willvincent\Feeds;

use Illuminate\Support\Arr;
use SimplePie;

class FeedsFactory
{
    /**
     * The config.
     *
     * @var array
     */
    protected $config;

    /**
     * @var SimplePie
     */
    protected $simplePie;

    /**
     * FeedsFactory constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param array $feedUrl RSS URL
     * @param int   $limit    items returned per-feed with multifeeds
     * @param bool  $forceFeed
     * @param null  $options
     * @return simplePie
     */
    public function make($feedUrl = [], $limit = 0, $forceFeed = false, $options = null)
    {
        $this->simplePie = new SimplePie();
        $this->configure();
        $this->simplePie->set_feed_url($feedUrl);
        $this->simplePie->set_item_limit($limit);

        if ($forceFeed === true) {
            $this->simplePie->force_feed(true);
        }

        $stripHtmlTags = Arr::get($this->config, 'strip_html_tags.disabled', false);

        if (! $stripHtmlTags && ! empty($this->config['strip_html_tags.tags']) && is_array($this->config['strip_html_tags.tags'])) {
            $this->simplePie->strip_htmltags($this->config['strip_html_tags.tags']);
        } else {
            $this->simplePie->strip_htmltags(false);
        }

        if (! $stripHtmlTags && ! empty($this->config['strip_attribute.tags']) && is_array($this->config['strip_attribute.tags'])) {
            $this->simplePie->strip_attributes($this->config['strip_attribute.tags']);
        } else {
            $this->simplePie->strip_attributes(false);
        }

        if (isset($this->config['curl.timeout']) && is_int($this->config['curl.timeout'])) {
            $this->simplePie->set_timeout($this->config['curl.timeout']);
        }

        if (isset($options) && is_array($options)) {
            if (isset($options['curl.options']) && is_array($options['curl.options'])) {
                $this->simplePie->set_curl_options($this->simplePie->curl_options + $options['curl.options']);
            }

            if (isset($options['strip_html_tags.tags']) && is_array($options['strip_html_tags.tags'])) {
                $this->simplePie->strip_htmltags($options['strip_html_tags.tags']);
            }

            if (isset($options['strip_attribute.tags']) && is_array($options['strip_attribute.tags'])) {
                $this->simplePie->strip_attributes($options['strip_attribute.tags']);
            }

            if (isset($options['curl.timeout']) && is_int($options['curl.timeout'])) {
                $this->simplePie->set_timeout($options['curl.timeout']);
            }
        }

        $this->simplePie->init();

        return $this->simplePie;
    }

    /**
     * Configure SimplePie.
     *
     * @return void
     */
    protected function configure()
    {
        $curlOptions = [];

        if ($this->config['cache.disabled']) {
            $this->simplePie->enable_cache(false);
        } else {
            $this->simplePie->set_cache_location($this->config['cache.location']);
            $this->simplePie->set_cache_duration($this->config['cache.life']);
        }

	    if (isset($this->config['user_agent']) && !empty($this->config['user_agent'])) {
		    $this->simplePie->set_useragent($this->config['user_agent']);
	    }

        if (isset($this->config['curl.options']) && is_array($this->config['curl.options'])) {
            $curlOptions += $this->config['curl.options'];
        }

        if ($this->config['ssl_check.disabled']) {
            $curlOptions[CURLOPT_SSL_VERIFYHOST] = false;
            $curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
        }

        if (is_array($curlOptions)) {
            $this->simplePie->set_curl_options($curlOptions);
        }
    }
}
