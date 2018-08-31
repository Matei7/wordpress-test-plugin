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
        add_action('admin_enqueue_scripts', array($this, 'load_css'));
        add_action('wp_ajax_input_picker', array($this, 'input_picker'));
        add_action('wp_ajax_nopriv_input_picker', array($this, 'input_picker'));
        add_action('wp_ajax_getCurrentValues', array($this, 'getCurrentValues'));
        add_action('wp_ajax_nopriv_getCurrentValues', array($this, 'getCurrentValues'));

        add_action('add_meta_boxes_post', array($this, 'wpplugin_add_custom_metabox'));
        add_action('save_post', array($this, 'wporg_save_postdata'));

    }


    public function load_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('sl-script-handle', plugin_dir_url(__DIR__) . "js/myscript.js", array('wp-color-picker', 'jquery'), false, true);
        wp_enqueue_script('ajax-script', plugin_dir_url(__DIR__) . "js/ajax-script.js", array('jquery'), false, true);
        wp_localize_script('ajax-script', 'my_ajax_object',
            array('ajax_url' => admin_url('admin-ajax.php')));

    }


    public function load_css()
    {
        wp_enqueue_style('wp-jquery', plugin_dir_url(__DIR__) . "css/jquery-ui.css");
        wp_enqueue_style('wp-admin-test-plugin', plugin_dir_url(__DIR__) . "css/admin-test-plugin.css");

    }


    function add_plugin_menu()
    {
        add_menu_page(
            __('Title', 'textdomain'),
            'Test plugin',
            'manage_options',
            plugin_dir_url(__DIR__) . "matei-test-plugin.php",
            array($this, 'display_options'), "",
            100
        );
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

        }
        die();
    }

    public function display_options()
    {
        include dirname(dirname(__FILE__)) . '\View\admin.html';
    }


    public function getCurrentValues()
    {

        $fp = fopen(dirname(dirname(__FILE__)) . "\css\matei-test-plugin2.css", "r");
        $data = fread($fp, filesize(dirname(dirname(__FILE__)) . "\css\matei-test-plugin2.css"));
        fclose($fp);
        $data = preg_replace("/[A-Za-z]*{/", "", $data);
        $data = str_replace("}", "", $data);
        $data = str_replace("!important", "", $data);
        $arr = explode(';', $data);
        $result = [];
        foreach ($arr as $key) {
            $val = explode(":", $key);
            $val[0] = trim($val[0]);
            $val[1] = trim($val[1]);
            $result[$val[0]] = $val[1];
        }
        array_pop($result);

        wp_send_json($result);
    }


    public function wpplugin_add_custom_metabox()
    {
        add_meta_box("test-plugin-metabox", __("My First MetaBox"), array($this, "render_metabox"), "post", 'normal', 'default');
    }


    public function render_metabox()
    {
        include dirname(dirname(__FILE__)) . '\View\render_metabox.html';
    }

    function wporg_save_postdata($post_id)
    {
        if (!empty($_POST)) {
            update_post_meta(
                $post_id,
                'css-post-' . $post_id, array(
                    "p" => array(
                        'letter-spacing' => $_POST['letter-spacing'],
                        'line-height' => $_POST['line-height'],
                        'color' => $_POST['color'],
                    ),
                )
            );


        }
    }

}

new AdminController();