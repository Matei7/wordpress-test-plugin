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
    }

    public function output_style_node()
    {

        global $wp_query;

        $post_list = $wp_query->posts;

        $size = count($post_list);

        for ($i = 0; $i < $size; $i++) {
            $id = $post_list[$i]->ID;
            $data = get_post_meta($id, 'css-post-' . $id)[0];
            if (is_array($data)) {
                $style = '';
                foreach ($data as $key => $value) {
                    if ($key != "color") {
                        $style .= "$key: $value" . "px !important;\n";
                    } else {
                        $style .= "$key: $value !important;\n";
                    }
                }
                ?>
                <style><?php echo "#post-" . $id . " p{" . $style . "}" ?></style>
                <?php
            }
        }

    }

}


new FrontEndController();