<?php


class WSRS_Helper
{
    public static function getNextUpdateTime($niceDisplay = false)
    {
        if ($niceDisplay) {
            return date('Y-m-d H:i:s',wp_next_scheduled(WSRS_Config::WSRS_CRON_HOOK_NAME));
        }

        return wp_next_scheduled(WSRS_Config::WSRS_CRON_HOOK_NAME);
    }
}