<!-- start prodotti mega menu  -->

<div class="set_mega_menu d-none">
    <div class="megamenu-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <?php foreach ($menu_categories as $menu_category) { ?>
                        <?php
                        $menu_category_name  = $menu_category->name;
                        $menu_category_id    = $menu_category->term_id;
                        $menu_sub_categories = get_terms(
                            array(
                                'taxonomy'      => 'collezione',
                                'parent'        => $menu_category_id,
                                'hide_empty'    => false
                            ),
                        );
                        $menu_category_link = get_term_link($menu_category_id);
                        ?>

                        <div class="megamenu-links-wrapper">

                            <h4><a href="<?php echo $menu_category_link ?>"></a><?php echo $menu_category_name ?></h4>

                            <ul>
                                <?php foreach ($menu_sub_categories as $menu_sub_category) { ?>
                                    <?php
                                    $menu_sub_category_name  = $menu_sub_category->name;
                                    $menu_sub_category_id    = $menu_sub_category->term_id;
                                    $menu_sub_sub_categories = get_terms(
                                        array(
                                            'taxonomy'      => 'collezione',
                                            'parent'        => $menu_sub_category_id,
                                            'hide_empty'    => false
                                        ),
                                    );
                                    $menu_sub_sub_category_name  = isset($menu_sub_sub_categories[0]) ? $menu_sub_sub_categories[0]->name : '';
                                    $menu_sub_sub_category_id    = isset($menu_sub_sub_categories[0]) ? $menu_sub_sub_categories[0]->term_id : '';
                                    ?>
                                    <?php if (count($menu_sub_sub_categories) > 0) { ?>
                                        <?php
                                        $menu_sub_category_product_arg = array(
                                            'post_type' => 'prodotti',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy'  => 'collezione',
                                                    'field'     => 'term_id',
                                                    'terms'     => $menu_sub_sub_category_id,
                                                ),
                                            ),
                                        );
                                        $menu_sub_category_product_query = new WP_Query($menu_sub_category_product_arg);
                                        $menu_sub_category_products      = $menu_sub_category_product_query->posts;
                                        ?>


                                        <li class="megamenu-parent-li">
                                            <a href="<?php echo site_url() ?>/prodotti">
                                                <span><?php echo $menu_sub_category_name ?> collection</span> <?php if ($menu_sub_sub_category_name != '') { ?>- <?php echo $menu_sub_sub_category_name ?><?php } ?>
                                                <span class="arrow-icon">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/arrow-right.png" alt="">
                                                </span>
                                            </a>
                                            <?php if ($menu_sub_category_product_query->have_posts()) { ?>
                                                <div class="mega-submenu-parent">
                                                    <ul class="mega-submenu">
                                                        <?php while ($menu_sub_category_product_query->have_posts()) { ?>
                                                            <?php
                                                            $menu_sub_category_product_query->the_post();
                                                            $post_id        = get_the_ID();
                                                            $product_url    = get_the_permalink();
                                                            $image_url      = get_template_directory_uri() . '/assets/images/accessori/pc1.png';
                                                            if (has_post_thumbnail()) {
                                                                $image_url = get_the_post_thumbnail_url($post_id);
                                                            }

                                                            $pkt_short_description  = get_field('pkt_short_description');
                                                            $post_title             = get_the_title();
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo $product_url ?>">
                                                                    <span> <?php echo $post_title ?></span> - <?php echo $pkt_short_description ?>
                                                                </a>
                                                                <div class="mega-submenu-imagebox">
                                                                    <img src="<?php echo $image_url; ?>" alt="">
                                                                </div>
                                                            </li>
                                                        <?php }
                                                        wp_reset_query();
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </li>
                                    <?php } else { ?>
                                        <li> <a href="<?php echo site_url() ?>/prodotti"> <?php echo $menu_sub_category_name ?> </a> </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>

                        </div>
                    <?php } ?>
                    <div class="visualizza-link">
                        <a href="<?php echo site_url() ?>/collezione/controtelai">visualizza tutti i prodotti e le collezioni <i class="fa-regular fa-chevron-right"></i></a>

                    </div>

                </div>

            </div>

        </div>

        <div class="megamenu-close-btn ">

            <button class="megamenu-close">

                <i class="fa-light fa-xmark"></i>

            </button>



        </div>

    </div>

</div>

<!-- end prodotti mega menu  -->
<!-- start chisiamo mega menu  -->
<div class="set_csm_mega_menu d-none">
    <div class="megamenu-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="megamenu-links-wrapper chi_siamo_mg_menu">
                        <?php
                        if (has_nav_menu('chi_siamo_mega_mnu')) {
                            wp_nav_menu(
                                array(
                                    'theme_location'      => 'chi_siamo_mega_mnu',
                                    'container_class'      => '',
                                    // 'walker' => new Custom_Walker_Nav_Menu(),
                                )
                            );
                        } else {
                        ?>
                            <p>There is not active menu for this location. Please setup from the menu option</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="megamenu-close-btn ">
            <button class="megamenu-close">
                <i class="fa-light fa-xmark"></i>
            </button>

        </div>
    </div>
</div>
<!-- end chisiamo mega menu  -->