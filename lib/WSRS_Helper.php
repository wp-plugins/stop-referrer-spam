<?php


class WSRS_Helper
{
    /**
     * @param bool|false $niceDisplay
     *
     * @return bool|int|string
     */
    public static function getNextUpdateTime($niceDisplay = false)
    {
        if ($niceDisplay) {
            return date('Y-m-d H:i:s',wp_next_scheduled(WSRS_Config::WSRS_CRON_HOOK_NAME));
        }

        return wp_next_scheduled(WSRS_Config::WSRS_CRON_HOOK_NAME);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public static function url($parameters = array())
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parsedUrl['query'], $parsedParams);
        $parameters = array_merge($parsedParams, $parameters);
        $url = esc_url(add_query_arg($parameters));

        return $url;
    }
}