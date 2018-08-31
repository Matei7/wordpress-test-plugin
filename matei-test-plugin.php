<?php
/*
Plugin Name: Wordpress Test Plugin
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: The Health Check Team
Author URI: http://health-check-team.example.com
Text Domain: health-check
Domain Path: /languages
*/


class TestPlugin
{


    /**
     * TestPlugin constructor.
     * @param $controller
     */
    public function __construct()
    {
        if (!is_admin()) {
            require_once  "Controller/FrontEndController.php";
        } else {
            require_once  "Controller/AdminController.php";

        }
    }

}

 new TestPlugin();




