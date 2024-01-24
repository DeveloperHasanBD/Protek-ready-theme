<?php



/**

 * redapple enqueue scripts

 *

 * @package redapple

 */



// Exit if accessed directly.

defined('ABSPATH') || exit;



if (!function_exists('understrap_scripts')) {

    /**

     * Load theme's JavaScript and CSS sources.

     */

    function understrap_scripts()

    {

        // Get the theme data.

        $theme_version = time();


        wp_enqueue_style('enq-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), $theme_version);
        wp_enqueue_style('enq-fontawesome-pro', get_template_directory_uri() . '/assets/css/fontawesome/fontawesome-pro.min.css', array(), $theme_version);
        wp_enqueue_style('enq-swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.css', array(), $theme_version);
        wp_enqueue_style('enq-magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), $theme_version);
        wp_enqueue_style('enq-select2', get_template_directory_uri() . '/assets/css/select2.min.css', array(), $theme_version);
        wp_enqueue_style('enq-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version);
        wp_enqueue_style('enq-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $theme_version);
        wp_enqueue_style('enq-theme-style', get_stylesheet_uri());


        wp_enqueue_script('jquery');

        wp_enqueue_script('enq-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), $theme_version, true);
        wp_enqueue_script('enq-swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array(), $theme_version, true);
        wp_enqueue_script('enq-magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array(), $theme_version, true);
        wp_enqueue_script('enq-select2', get_template_directory_uri() . '/assets/js/select2.min.js', array(), $theme_version, true);
        wp_enqueue_script('enq-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true);
        wp_enqueue_script('enq-ajax-data', get_template_directory_uri() . '/assets/js/ajax-data.js', array(), $theme_version, true);
        wp_enqueue_script('enq-af-ajax-data', get_template_directory_uri() . '/assets/js/af-ajax-data.js', array(), $theme_version, true);



        wp_localize_script('enq-ajax-data', 'action_url_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
        wp_localize_script('enq-af-ajax-data', 'action_url_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);





        if (is_singular() && comments_open() && get_option('thread_comments')) {

            wp_enqueue_script('comment-reply');

        }

    }

} // End of if function_exists( 'understrap_scripts' ).



add_action('wp_enqueue_scripts', 'understrap_scripts');

