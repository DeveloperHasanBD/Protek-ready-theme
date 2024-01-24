<?php

/**
 * The template for displaying search results pages
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

$search_val = $_GET['s'] ?? '';
$args = [
	'post_type'  => 'prodotti',
	'posts_per_page' => -1,
	'_meta_or_title' => $search_val,   // Our new custom argument!
	'meta_query'    => [
		[
			'key'     => 'pkt_short_description',
			'value'   => $search_val,
			'compare' => 'like'
		]
	],
];
$search_query = new WP_Query($args);
?>
<main>
	<!-- breadcrumb section start from here  -->
	<section class="breadcrumb-main ">
		<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">PROTEK HOME</a></li>

							<li class="breadcrumb-item active" aria-current="page">search results</li>
						</ol>
					</div>
				</div>
			</div>

		</nav>
	</section>
	<!-- breadcrumb section ends here  -->
	<section class="avanzata-banner-main search-banner-main d-none">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h2>search results</h2>

				</div>
			</div>
		</div>
	</section>

	<!-- search result section start from here  -->

	<section class="search-result-main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="result-title">
						<h3>search results</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="search-result-lists">
						<?php $result_index = 1; ?>
						<?php if ($search_query->have_posts() && $search_val != '') { ?>
							<ul>
								<?php while ($search_query->have_posts()) { ?>
									<?php
									$search_query->the_post();
									$post_id        = get_the_ID();
									$product_url    = get_the_permalink();
									$pkt_short_description  = get_field('pkt_short_description');
									$post_title             = get_the_title();
									?>
									<li>
										<a href="<?php echo $product_url ?>"> <span><?php echo $result_index ?>.</span> <?php echo $post_title ?> - <?php echo $pkt_short_description ?></a>
									</li>
									<?php $result_index++; ?>
								<?php } ?>
							<?php } else { ?>
								<p style="color: #c11b27;">No result found!</p>
							<?php } ?>
							<!-- <li>
								<a href="#"><span>2.</span> ed ut perspiciatis unde omnis iste natus error sit
									voluptatem
									accusantium

								</a>
							</li>
							<li>
								<a href="#"><span>3.</span> ed ut perspiciatis unde omnis iste natus error sit
									voluptatem
									accusantium

								</a>
							</li>
							<li>
								<a href="#"><span>4.</span> ed ut perspiciatis unde omnis iste natus error sit
									voluptatem
									accusantium

								</a>
							</li>
							<li>
								<a href="#"><span>5.</span> ed ut perspiciatis unde omnis iste natus error sit
									voluptatem
									accusantium

								</a>
							</li> -->
							</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- search result section start from here  -->
</main>
<?php
get_footer();
