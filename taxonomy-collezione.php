<?php

get_header();

?>

<?php
$get_current_term_id = get_queried_object()->term_id;

$categories = get_terms(
    array(
        'taxonomy' => 'collezione',
        'parent' => $get_current_term_id,
        'hide_empty' => false
    ),
);
// echo '<pre>';
// print_r($categories);
// die;
$is_left_product_active = 1;
?>
<main class="colozioni">

    <section class="breadcrumb-main ">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <ol class="breadcrumb">

                            <?php

                            if (function_exists('bcn_display')) {

                                bcn_display();
                            }

                            ?>

                        </ol>

                    </div>

                </div>

            </div>



        </nav>

    </section>

    <?php foreach ($categories as $category) { ?>
        <?php
        $category_name  = $category->name;
        $category_id    = $category->term_id;
        $sub_categories = get_terms(
            array(
                'taxonomy'      => 'collezione',
                'parent'        => $category_id,
                'hide_empty'    => false
            ),
        );
        $category_bg_color      = get_term_meta($category_id, 'cat_background_color', true);
        $category_title_color   = get_term_meta($category_id, 'cat_title_color', true);
        $category_bg_image_id   = get_term_meta($category_id, 'col_trm_image', true);
        $category_bg_image      = get_template_directory_uri() . "/assets/images/category/catbanner.png";
        if ($category_bg_image_id) {
            $category_bg_image = wp_get_attachment_url($category_bg_image_id);
        }
        if ($category_bg_color == '') {
            $category_bg_color = '#fff';
        }
        if ($category_title_color == '') {
            $category_title_color = '#000';
        }
        $sub_category_name  = isset($sub_categories[0]) ? $sub_categories[0]->name : '';
        $sub_category_id    = isset($sub_categories[0]) ? $sub_categories[0]->term_id : '';
        $remove_class_add   = '';

        if ($sub_category_name == '') {
            $remove_class_add   = 'remobe_bar';
        }

        if ($sub_category_id == '') {
            $sub_category_id = $category_id;
        }
        $sub_category_product_arg = array(
            'post_type' => 'prodotti',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'collezione',
                    'field'     => 'term_id',
                    'terms'     => $sub_category_id,
                ),
            ),
        );
        $sub_category_product_query = new WP_Query($sub_category_product_arg);
        $sub_category_products      = $sub_category_product_query->posts;

        ?>
        <?php if ($is_left_product_active == 1) { ?>
            <?php $is_left_product_active = 0; ?>
            <section id="<?php  echo $category->slug?>" class="accessori-banner-main category-banner-main" style="background: <?php echo $category_bg_color ?>;">

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <div class="banner-contentbox">

                                <div class="titlebox">
                                    <h2 class="<?php echo $remove_class_add; ?>" style="color:<?php echo $category_title_color; ?>"><?php if ($sub_category_name != '') { ?><?php echo $sub_category_name ?> <line_bar>|</line_bar><?php }?>  <span class="<?php echo $remove_class_add; ?>" style="color:<?php echo $category_title_color; ?>"> <?php echo $category_name ?> collection</span> </h2>
                                </div>
                                <div class="category-banner-grid">
                                    <?php if ($sub_category_product_query->have_posts()) { ?>
                                        <?php while ($sub_category_product_query->have_posts()) { ?>
                                            <?php
                                            $sub_category_product_query->the_post();
                                            $post_id        = get_the_ID();
                                            $product_url    = get_the_permalink();
                                            $image_url      = get_template_directory_uri() . '/assets/images/accessori/pc1.png';
                                            if (has_post_thumbnail()) {
                                                $image_url = get_the_post_thumbnail_url($post_id);
                                            }

                                            $pkt_short_description  = get_field('pkt_short_description');
                                            $post_title             = get_the_title();
                                            ?>
                                            <div class="common-single-collection">
                                                <a href="<?php echo $product_url ?>"></a>
                                                <div class="image-box">
                                                    <img src="<?php echo $image_url ?>" alt="<?php echo $post_title ?>">
                                                    <div class="content-box">
                                                        <div class="content">
                                                            <p><?php echo $pkt_short_description ?></p>
                                                            <h5><a href="<?php echo $product_url ?>"><?php echo $post_title ?></a></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <div class="banner-image-box">

                                <img src="<?php echo $category_bg_image ?>" alt="">

                            </div>

                        </div>



                    </div>

                </div>

            </section>
        <?php } else { ?>
            <?php $is_left_product_active = 1; ?>
            <section id="<?php  echo $category->slug?>" class="category-revers-main" style="background: <?php echo $category_bg_color ?>;">
                <div class="container">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <div class="revers-image-box">

                                <img src="<?php echo $category_bg_image ?>" alt="">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <div class="revers-titlebox title-color-white title-right">
                                <h3 class="<?php echo $remove_class_add; ?>" style="color:<?php echo $category_title_color; ?>">
                                    <?php if ($sub_category_name != '') { ?>
                                        <?php echo $sub_category_name ?> <line_bar class="">|</line_bar> <?php } ?>
                                    <span style="color:<?php echo $category_title_color; ?>"> <?php echo $category_name ?> collection</span>
                                </h3>
                            </div>

                            <div class="revers-common-grid">
                                <?php if ($sub_category_product_query->have_posts()) { ?>
                                    <?php while ($sub_category_product_query->have_posts()) { ?>
                                        <?php
                                        $sub_category_product_query->the_post();
                                        $post_id        = get_the_ID();
                                        $product_url    = get_the_permalink();
                                        $image_url      = get_template_directory_uri() . '/assets/images/accessori/pc1.png';
                                        if (has_post_thumbnail()) {
                                            $image_url = get_the_post_thumbnail_url($post_id);
                                        }

                                        $pkt_short_description  = get_field('pkt_short_description');
                                        $post_title             = get_the_title();
                                        ?>
                                        <div class="revers-single-grid">

                                            <a href="<?php echo $product_url ?>"></a>

                                            <div class="revers-content-box">
                                                <p><?php echo $pkt_short_description ?></p>
                                                <div class="title"><?php echo $post_title ?></div>
                                            </div>

                                        </div>
                                <?php }
                                } ?>
                            </div>

                        </div>

                    </div>

                </div>
            </section>
        <?php } ?>

    <?php } ?>

</main>

<?php

get_footer();
