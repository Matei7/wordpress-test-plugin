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
        add_action('wp_head', array($this, 'output_style_node'));
    }

    function load_css()
    {
        wp_enqueue_style('wp-test-plugin', plugin_dir_url(__DIR__) . "css/matei-test-plugin.css");
        wp_enqueue_style('wp-input-picker-plugin', plugin_dir_url(__DIR__) . "css/matei-test-plugin2.css");
        wp_enqueue_style('wp-edit-plugin', plugin_dir_url(__DIR__) . "css/plugin-edit.css");
    }

    public function output_style_node()
    {
        $id = get_the_ID();
        global $wpdb;
        $querystr = "SELECT * FROM  $wpdb->postmeta WHERE  $wpdb->postmeta.post_id = '$id' AND $wpdb->postmeta.meta_key like 'css%'";
        $pageposts = $wpdb->get_results($querystr);

        $style = '';
        for ($i = 0; $i < count($pageposts); $i++) {
            $key = str_replace("css-", "", $pageposts[$i]->meta_key);
            $value = $pageposts[$i]->meta_value;
            if ($key != "color") {
                $style .= "$key: $value px !important;\n";
            } else {
                $style .= "$key: $value !important;\n";
            }
        }

        ?>
        <style><?php echo "#post-" . $id . " p{" . $style . "}" ?></style>
        <?php


    }

}


new FrontEndController();