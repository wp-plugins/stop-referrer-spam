<?php


class WSRS_ConfigurationPage
{
    private $blacklistHandler;

    private $data;

    public function __construct()
    {
        $this->blacklistHandler = new WSRS_BlacklistHandler();
    }

    public function configurationPage()
    {
        $this->processParameters();
        $data = $this->data;
        $data['blacklist'] = $this->blacklistHandler->getBlacklistArray();
        include_once(WSRS_ROOT_DIR."/views/config-page.php");
    }

    public function processParameters()
    {
        if (isset($_GET['force_refresh']) && 1 == $_GET['force_refresh']) {
            $this->blacklistHandler->refreshBlacklist();
            $this->data['message'] = "Blacklist refreshed.";
        }
    }
}