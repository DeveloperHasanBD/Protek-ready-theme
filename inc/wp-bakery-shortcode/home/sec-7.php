<?php
add_action('vc_before_init', 'redp_home_sec_7_backend');
function redp_home_sec_7_backend()
{

    vc_map(
        array(
            "name"          => __("News & eventi", "redapple"), // Element name
            "base"          => "redp_home_sec_7", // Element shortcode
            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description'   => 'Dedicated for redapple',
            "class"         => "redapple-cstm",
            "category"      => __('Home', 'redapple'),
            "params" => array(
                array(
                    "type"          => "textfield",
                    "heading"       => "News Title",
                    "param_name"    => "hm_s7_title",
                ),
            ),
        )
    );
}


add_shortcode('redp_home_sec_7', 'redp_home_sec_7_view');

function redp_home_sec_7_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'hm_s7_title'               => '',
    ), $atts, 'redp_home_sec_7');

    $hm_s7_title           = $atts['hm_s7_title'] ?? '';
?>

    <!-- home news slider start from here  -->
    <section class="homenews-slider-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="home-common-title">
                        <h2><?php echo $hm_s7_title; ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="news-slider-box">
                        <div class="swiper homenews-slider">
                            <div class="swiper-wrapper">
                                <?php
                                $nevnt_args = array(
                                    'post_type'         => 'post',
                                    'posts_per_page'    => -1,
                                );
                                $nevnt_query = new WP_Query($nevnt_args);
                                if ($nevnt_query->have_posts()) {
                                    while ($nevnt_query->have_posts()) {
                                        $nevnt_query->the_post();
                                        $subdescription = get_field('post_sub_description');
                                ?>
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <div class="image-box">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                        if (has_post_thumbnail()) {
                                                        ?>
                                                            <img src="<?php echo the_post_thumbnail_url('full') ?>" alt="">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/12/default.png" alt="">
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="news-short-box">
                                                        <h4>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                                            </a>
                                                        </h4>
                                                        <h6><?php echo get_field('post_sub_title'); ?></h6>
                                                        <p><?php echo wp_trim_words($subdescription, 15, true); ?>...</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                    wp_reset_query();
                                }
                                ?>

                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home news slider start from here  -->

<?php

    $result = ob_get_clean();

    return $result;
}
