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


function load_css()
{
    wp_enqueue_style('wp-test-plugin', plugin_dir_url(__FILE__) . "css/matei-test-plugin.css");
}


function test_plugin_callback()
{
    include_once "input-picker.php";
}


function test_plugin_widget()
{
    add_menu_page(
        __('Title', 'textdomain'),
        'Test plugin',
        'manage_options',
        plugin_dir_url(__FILE__) . "matei-test-plugin.php",
        'test_plugin_callback',
        100
    );
}

function input_picker()
{
    if (isset($_REQUEST)) {
        $data = "\np{
            line-height: {$_REQUEST['line_height']}px !important;
            letter-spacing: {$_REQUEST['spacing']}px !important;
            color: {$_REQUEST['color']} !important;       
        }\n";
        $fp = fopen(__DIR__ . "/css/matei-test-plugin.css", "a+");
        fwrite($fp, $data);
        fclose($fp);
        echo "Success";
    }

    die();
}

function ajax_enqueue()
{
    wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__) . "js/ajax-script.js", array('jquery'));
    wp_localize_script('ajax-script', 'my_ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php')));
}

if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'load_css');

} else {
    add_action('admin_menu', 'test_plugin_widget');
    add_action('admin_enqueue_scripts', 'softlights_admin_scripts');
    function softlights_admin_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('sl-script-handle', plugin_dir_url(__FILE__) . "js/myscript.js", array('wp-color-picker', 'jquery'), false, true);
    }

    add_action('admin_enqueue_scripts', 'ajax_enqueue');
    add_action('wp_ajax_input_picker', 'input_picker');
    add_action('wp_ajax_nopriv_input_picker', 'input_picker');

}



