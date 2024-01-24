<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>
<?php

$page_id 			= get_the_ID();
$transparent_class 	= '';
$server 			= $_SERVER['REQUEST_URI'];
$explode_server 	= explode('/', $server);
$remove_blur_bg 	= '';
$tra_margin			= '';

if ((in_array('protek-home', $explode_server)) || ($page_id == 263)) {
	$transparent_class 	= 'transparent-header';
	$tra_margin			= 'tra_margin';
}else {
	$transparent_class  = 'bg-white';
}

$header_t_logo = get_field('ptk_transparent_logo','options');
$header_n_logo = get_field('ptk_normal_logo','options');
?>

<body <?php body_class($tra_margin) ?>>

	<header>
		<div class="main-header <?php echo $transparent_class; ?>" id="main-header">
			<div class="container">
				<div class="header-flex">
					<div class="logo-box">
						<?php
						if ((in_array('protek-home', $explode_server)) || ($page_id == 263)) {
						?>
							<a href="<?php echo home_url(); ?>/protek-home">
								<img src="<?php echo $header_t_logo;?>" alt="" class="hide-scroll">
								<img src="<?php echo $header_n_logo;?>" class="show-scrool">
							</a>
						<?php
						} else {
						?>
							<a href="<?php echo home_url(); ?>/protek-home">
								<img src="<?php echo $header_n_logo;?>" class="show-scrool">
							</a>
						<?php
						}
						?>

					</div>
					<div class="main-header-items">
						<?php
						if (has_nav_menu('primary_menu')) {
							wp_nav_menu(
								array(
									'theme_location'  	=> 'primary_menu',
									'container_class'  	=> 'parent-ul',
									// 'walker' => new Custom_Walker_Nav_Menu(),
								)
							);
						} else {
						?>
							<p>There is not active menu for this location. Please setup from the menu option</p>
						<?php
						}
						?>
						<ul class="d-none parent-ul">
							<li class="megamenu-parent">
								<a href="javascript:void(0);" class="show-megamenu">prodotti</a>
							</li>
							<li class="megamenu-parent">
								<a href="javascript:void(0);" class="show-megamenu">chi siamo</a>
							</li>
							<li>
								<a href="#">SOSTENIBILITà</a>
							</li>
							<li>
								<a href="#">news/eventi</a>
							</li>
							<li>
								<a href="#">CONTATTI</a>
							</li>
							<li class="protekdesing">
								<a href="#">PROTEK+DESIGN</a>
							</li>
							<li>
								<a href="#">Area Download</a>
							</li>
							<li>
								<a href="#">Ricerca avanzata </a>
							</li>
							<li>
								<a href="#"><i class="fa-regular fa-magnifying-glass"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa-light fa-circle-user"></i></a>
							</li>
							<li>
								<a href="#">ITA</a>
								<ul class="sub-menu d-none">
									<li>
										<a href="#">ENG</a>
									</li>

								</ul>
							</li>
						</ul>
					</div>
					<div class="bars sidebar-toggler-btn">
						<i id="openButton" class="fa-solid fa-bars"></i>
					</div>
				</div>
			</div>


		</div>
	</header>


	<?php
	// start mobile and mega menu 
	// include_once("inc/menu-parts.php");
	$menu_categories = get_terms(

		array(
			'taxonomy'      => 'collezione',
			'parent'        => 0,
			'hide_empty'    => false
		),
	);


	// echo '<pre>';
	// print_r($menu_categories);
	include_once("inc/menu-parts/mega-menu.php");
	include_once("inc/menu-parts/mobile-fixed-menu.php");
	include_once("inc/menu-parts/mobile-menu.php");
	?>