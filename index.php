<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
// if (function_exists('bcn_display')) {
// 	bcn_display();
// }


$post_args = array(
    'post_type'  => 'post',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
);
$post_query = new WP_Query($post_args);
// echo '<pre>';
// print_r($post_query->posts);
// die;
?>

<main>
    <!-- breadcrumb section start from here  -->
    <section class="breadcrumb-main">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo home_url()?>/protek-home">PROTEK HOME</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> NEWS/EVENTI</li>
                        </ol>
                    </div>
                </div>
            </div>

        </nav>
    </section>
    <!-- breadcrumb section ends here  -->

    <!-- news banner start from here  -->
    <section class="avanzata-banner-main news-banner-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2>NEWS/EVENTI</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- <?php
            // echo '<pre>';
            // print_r($_SESSION['home_post_filter']);
            ?> -->
    <!-- news banner start from here  -->
    <section class="all-newslist-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="news-links">
                        <ul>
                            <li>
                                <a href="#" class="home_filter active filter_all">tutti</a>
                            </li>
                            <li>
                                <a href="#" class="home_filter filter_news">news</a>
                            </li>
                            <li>
                                <a href="#" class="home_filter filter_event">eventi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" id="home_post_container">
                <?php
                if (have_posts()) {
                    // Start the Loop.
                    while (have_posts()) {
                        the_post();

                        /*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
                        get_template_part('loop-templates/content', get_post_format());
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <?php understrap_pagination(); ?>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
