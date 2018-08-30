<?php
/**
 * Created by PhpStorm.
 * User: PC-1076
 * Date: 8/30/2018
 * Time: 10:51 AM
 */

class AdminController
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {

        add_action('admin_menu', array($this, 'add_plugin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'load_scripts'));
        add_action('wp_ajax_input_picker', array($this, 'input_picker'));
        add_action('wp_ajax_nopriv_input_picker', array($this, 'input_picker'));
    }


    public function load_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('sl-script-handle', plugin_dir_url(__DIR__) . "js/myscript.js", array('wp-color-picker', 'jquery'), false, true);
        wp_enqueue_script('ajax-script', plugin_dir_url(__DIR__) . "js/ajax-script.js", array('jquery'), false, true);
        wp_localize_script('ajax-script', 'my_ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php')));

    }


    function add_plugin_menu()
    {
        add_menu_page(
            __('Title', 'textdomain'),
            'Test plugin',
            'manage_options',
            plugin_dir_url(__DIR__) . "matei-test-plugin.php",
            array($this, 'plugin_callback'), "",
            100
        );
    }


    function plugin_callback()
    {
        $this->display_options();
    }


    public function input_picker()
    {

        if (isset($_REQUEST)) {
            $data = "\np{
            line-height: {$_REQUEST['line_height']}px !important;
            letter-spacing: {$_REQUEST['spacing']}px !important;
            color: {$_REQUEST['color']} !important;       
        }\n";

            $fp = fopen(dirname(dirname(__FILE__)) . "\css\matei-test-plugin2.css", "wb");
            fwrite($fp, $data);
            fclose($fp);
            echo "Success";
        }
        die();
    }

    private function display_options()
    {
        include dirname(dirname(__FILE__)) . '\View\admin.html';
    }
}

new AdminController();