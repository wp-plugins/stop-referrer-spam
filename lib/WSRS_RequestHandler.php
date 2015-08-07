<?php


class WSRS_RequestHandler
{
    /**
     * @var WP_Query
     */
    private $wpQuery;

    /**
     * @var WSRS_BlacklistHandler
     */
    private $blacklist;

    public function __construct()
    {
        global $wp_query;

        $this->wpQuery = $wp_query;
        $this->blacklist = new WSRS_BlacklistHandler();
    }

    public function filterRequest($request)
    {
        if ($this->checkIfReferrerHostIsBlacklisted()) {
            $this->display404();
        }

        return $request;
    }

    public function checkIfReferrerHostIsBlacklisted()
    {
        if (false === ($referrerHost = $this->getReferrerHost())) {
            return false;
        }
        $blacklist = $this->blacklist->getBlacklistArray();
        foreach ($blacklist as $blacklistedDomain) {
            if (false !== stripos($referrerHost, $blacklistedDomain)) {
                return true;
            }
        }

        return false;
    }

    private function getReferrerHost()
    {
        if (false === ($referrer = $this->getReferrer())) {
            return false;
        }

        return parse_url($referrer, PHP_URL_HOST);
    }

    private function getReferrer()
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return false;
        }
        $referrer = $_SERVER['HTTP_REFERER'];
        if (empty($referrer)) {
            return false;
        }

        return $referrer;
    }

    public function display404($noTemplate = true)
    {
        status_header(404);
        if (!$noTemplate) {
            $this->wpQuery->set_404();
            get_template_part(404);
        }
        exit();
    }
}