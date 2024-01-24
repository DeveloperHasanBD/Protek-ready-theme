<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

$server 			= $_SERVER['REQUEST_URI'];
$explode_server 	= explode('/', $server);
$remove_blur_bg 	= '';


if (in_array('chi-siamo', $explode_server)) {
	$remove_blur_bg 	= 'remove_blur_bg chisiamo';
}

?>
<main class="<?php echo $remove_blur_bg; ?>">
	<?php
	
	while (have_posts()) {
		the_post();
		get_template_part('loop-templates/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	}
	?>
</main>
<?php
get_footer();
