<?php

function load_css()
{
    wp_register_style('style', plugin_dir_url("wordpress-test-plugin/css/style.css"));
    wp_enqueue_style('style');
}


if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'load_css');
}