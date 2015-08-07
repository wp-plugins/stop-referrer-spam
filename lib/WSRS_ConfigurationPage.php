<?php


class WSRS_ConfigurationPage
{
    public function __construct()
    {
        $this->blacklistHandler = new WSRS_BlacklistHandler();
    }

    public function configurationPage()
    {
        $blacklistHandler = $this->blacklistHandler;
        include_once(WSRS_ROOT_DIR."/views/config-page.php");
    }
}