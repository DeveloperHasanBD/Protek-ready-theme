<?php

add_filter('acf/format_value/type=text', 'do_shortcode');
include_once("inc/theme-options/acf-theme-options.php");
include_once("inc/acf-code/acf-code.php");
include_once("inc/db-table/db-table.php");
include_once("inc/ajax/ajax-data-processing.php");
include_once("inc/ajax/af-ajax-data.php");
include_once("inc/woo/hook.php");
include_once("inc/menu-parts/search-n-extra.php");

// include_once("inc/nel-mondo/country-search.php");
// include_once("inc/woo/woo-ajax/product-filter.php");

/**
 * redapple functions and definitions
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// redapple's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/redapple/redapple/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/tgm.php',                      	// Load deprecated functions.
	'/wp-bakery-shortcode.php',             // Load deprecated functions.
	// 	'/acf-gutenberg-blocks.php',            // Load deprecated functions.
	//      '/elementor-shortcode.php',             // Load deprecated functions.


);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ($understrap_includes as $file) {
	require_once get_theme_file_path($understrap_inc_dir . $file);
}

// header class 
function header_class_setup($class)
{
	if (is_front_page()) {
	} else {
		$class = ' ';
	}
	return $class;
}
add_filter('class_change_as_page', 'header_class_setup');


function wp_bakery_dropdown_css()
{
?>
	<style>
		.wpb-input.wpb-select.dropdown.yes {
			max-width: 100%;
		}

		.wpb_vc_param_value {
			max-width: 100% !important;
		}
	</style>
<?php
}
add_action('pre_get_posts', function ($q) {
    if ($title = $q->get('_meta_or_title')) {
        add_filter('get_meta_sql', function ($sql) use ($title) {
            global $wpdb;

            // Only run once:
            static $nr = 0;
            if (0 != $nr++) return $sql;

            // Modify WHERE part:
            $sql['where'] = sprintf(
                " AND ( %s OR %s ) ",
                $wpdb->prepare("{$wpdb->posts}.post_title LIKE '%s'", '%'.$title.'%'),
                mb_substr($sql['where'], 5, mb_strlen($sql['where']))
            );
            return $sql;
        });
    }
});
add_action('admin_enqueue_scripts', 'wp_bakery_dropdown_css');



