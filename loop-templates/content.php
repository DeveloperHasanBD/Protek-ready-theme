<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package redapple
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 custom-col">
    <div class="card">
        <div class="row g-0">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="news-image-box">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) { ?>
                            <img src="<?php echo the_post_thumbnail_url(); ?>" alt="" style="height: 250px; width: 100%;">
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
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card-body">
                    <div class="news-short-box">
                        <h4>
                            <a href="<?php the_permalink(); ?>"><?php echo get_the_title() ?></a>
                        </h4>
                        <h6><?php echo $subtitle; ?></h6>
                        <p><?php echo wp_trim_words($subdescription, 15, true); ?>...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>