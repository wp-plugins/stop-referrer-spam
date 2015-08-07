<?php


class WSRS_BlacklistHandler
{
    public function refreshBlacklist()
    {
        $blacklistRawResponse = wp_remote_get(WSRS_Config::WSRS_BLACKLIST_SOURCE);
        if ($blacklistRawResponse instanceof WP_Error) {
            error_log('Wordpress WSRS: error when getting blacklist: ' . $blacklistRawResponse->get_error_message());
            return;
        }
        $blacklistJson = $blacklistRawResponse['body'];
        if (empty($blacklistJson)) {
            error_log('Wordpress WSRS: default blacklist empty');
            return;
        }

        $cachedBlacklistJson = get_option(WSRS_Config::WSRS_OPTION_BLACKLIST);
        if (false !== $cachedBlacklistJson && md5($blacklistJson) === md5($cachedBlacklistJson)) {
            return;
        }
        update_option(WSRS_Config::WSRS_OPTION_BLACKLIST, $blacklistJson);
    }

    public function getBlacklistArray()
    {
        $blacklistJson = get_option(WSRS_Config::WSRS_OPTION_BLACKLIST);
        if (false === ($blacklist = json_decode($blacklistJson, true)))
        {
            return array();
        }

        return $blacklist;
    }
}