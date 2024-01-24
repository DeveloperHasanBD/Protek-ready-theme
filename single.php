<?php

/**
 * The template for displaying all single posts
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main>
    <!-- breadcrumb section start from here  -->
    <section class="breadcrumb-main">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ol class="breadcrumb">
                            <?php
                            // if (function_exists('bcn_display')) {
                            //     bcn_display();
                            // }
                            ?>
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
    <!-- news banner start from here  -->
    <section class="newsdetails-main">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="news-image-box">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <img src="<?php echo the_post_thumbnail_url('full'); ?>" alt="">
                                        <?php } else { ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/news/news.png" alt="">
                                        <?php } ?>
                                    </a>
                                </div>


                            </div>
                            <?php
                            $subtitle = get_field('post_sub_title', get_the_ID(),);
                            $subdescription = get_field('post_sub_description', get_the_ID(),);
                            ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="card-body">
                                    <div class="news-short-box">
                                        <h4> <?php echo get_the_title() ?> </h4>
                                        <h6><?php echo $subtitle; ?></h6>
                                        <p><?php echo $subdescription; ?></p>
                                        <p><?php the_content(); ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<?php
get_footer();
