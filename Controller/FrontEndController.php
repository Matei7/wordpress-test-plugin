<?php
/**
 * Created by PhpStorm.
 * User: PC-1076
 * Date: 8/30/2018
 * Time: 10:53 AM
 */

class FrontEndController
{

    /**
     * FrontEndController constructor.
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array('FrontEndController', 'load_css'));
    }

    function load_css()
    {
        wp_enqueue_style('wp-test-plugin', plugin_dir_url(__DIR__) . "css/matei-test-plugin.css");
        wp_enqueue_style('wp-input-picker-plugin', plugin_dir_url(__DIR__) . "css/matei-test-plugin2.css");
        wp_enqueue_style('wp-edit-plugin', plugin_dir_url(__DIR__) . "css/plugin-edit.css");
    }

}


new FrontEndController();