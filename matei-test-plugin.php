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
    wp_enqueue_style('wp-test-plugin-css', plugin_dir_url(__FILE__) . "css/matei-test-plugin.css");
}


function test_plugin_callback()
{
    echo '<h1>Test plugin </h1 >';
}


function test_plugin_widget()
{
    add_menu_page(
        __('Custom Menu Title', 'textdomain'),
        'Test plugin',
        'manage_options',
        plugin_dir_url(__FILE__) . "matei-test-plugin.php",
        'test_plugin_callback',
        100
    );
}


if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'load_css');
} else {
    add_action('admin_menu', 'test_plugin_widget');
}