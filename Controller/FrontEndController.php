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
        $color = get_post_meta($id, 'css-color', true);
        $height = get_post_meta($id, 'css-line_height', true);
        $spacing = get_post_meta($id, 'css-letter_spacing', true);
?>

        <style>
            #post-<?php echo $id?> p {
                letter-spacing: <?php echo $spacing?>px!important;
                line-height:<?php echo $height?>px !important;
                color:<?php echo $color?> !important;
            }

        </style>


<?php
    }

}


new FrontEndController();