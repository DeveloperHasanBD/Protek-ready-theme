<!-- sidebar section start from here  -->

<?php 
    $mobile_categories = get_terms(

		array(
			'taxonomy'      => 'collezione',
			'parent'        => 44,
			'hide_empty'    => false
		),
	);

    $mobile_menus = get_field('ptk_main_page','option');
    $mobile_logo = get_field('pkt_mobile_logo','option');
?>

<div class="sidebar-area sidebar-hide" id="targetElement">
    <div class="logo">
        <a href="<?php echo home_url()?>/protek-home">
            <img src="<?php echo $mobile_logo;?>" alt="">
        </a>
    </div>
    <button id="closeButton" class="">
        <i class="fa-regular fa-bars"></i>
    </button>
    <div class="mobile-menu-items">
        <ul>
            <li><a href="<?php echo site_url()?>/prodotti">prodotti <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <?php foreach($mobile_categories as $mobile_category){?>
                        <?php 
                            $mobile_sub_category_name  = $mobile_category->name;    
                            $mobile_sub_category_id    = $mobile_category->term_id;
                            $mobile_sub_sub_categories = get_terms(
                                array(
                                    'taxonomy'      => 'collezione',
                                    'parent'        => $mobile_sub_category_id,
                                    'hide_empty'    => false
                                ),
                            );
                            $mobile_sub_category_link = get_term_link(44);
                            $mobile_sub_sub_category_name  = isset($mobile_sub_sub_categories[0]) ? $mobile_sub_sub_categories[0]->name : '';
                            $mobile_sub_sub_category_id    = isset($mobile_sub_sub_categories[0]) ? $mobile_sub_sub_categories[0]->term_id : '';    
                        ?>
                        <li>
                            <a href="<?php echo $mobile_sub_category_link?>#<?php echo $mobile_category->slug?>">

                                <?php echo $mobile_sub_category_name?> collections
                                <?php if($mobile_sub_sub_category_name != ''){?><span><?php echo $mobile_sub_sub_category_name?></span><?php }?>
                                <i class="fa-regular fa-chevron-right"></i>

                            </a>
                            <?php if($mobile_sub_sub_category_id != ''){?>
                                <?php 
                                    $mobile_sub_category_product_arg = array(
                                        'post_type' => 'prodotti',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'collezione',
                                                'field'     => 'term_id',
                                                'terms'     => $mobile_sub_sub_category_id,
                                            ),
                                        ),
                                    );
                                    $mobile_sub_category_product_query = new WP_Query($mobile_sub_category_product_arg);
                                    $mobile_sub_category_products      = $mobile_sub_category_product_query->posts;    
                                ?>
                                <ul>
                                    <?php if ($mobile_sub_category_product_query->have_posts()) { ?>
                                        <?php while ($mobile_sub_category_product_query->have_posts()) { ?>
                                            <?php
                                                $mobile_sub_category_product_query->the_post();
                                                $mobile_post_id        = get_the_ID();
                                                $mobile_product_url    = get_the_permalink();
                                                $mobile_image_url      = get_template_directory_uri() . '/assets/images/accessori/pc1.png';
                                                if (has_post_thumbnail()) {
                                                    $mobile_image_url = get_the_post_thumbnail_url($mobile_post_id);
                                                }

                                                $mobile_pkt_short_description  = get_field('pkt_short_description');
                                                $mobile_post_title             = get_the_title();
                                            ?>
                                            <li><a href="<?php echo $mobile_product_url;?>"><?php echo $mobile_post_title;?> - <?php echo $mobile_pkt_short_description;?></a></li>
                                        <?php } wp_reset_query();?>
                                    <?php }?>
                                </ul>
                            <?php }?>
                        </li>
                    <?php }?>
                </ul>
            </li>
            <?php if($mobile_menus){?>
                <?php foreach($mobile_menus as $mobile_menu){?>
                    <li><a href="<?php echo $mobile_menu['ptk_page_url']?>"><?php echo $mobile_menu['ptk_page_title']?> 
                    <?php if($mobile_menu['ptk_sub_page']){?><i class="fa-regular fa-chevron-right"></i><?php }?></a>
                        <?php if($mobile_menu['ptk_sub_page']){?>
                            <ul>
                                <?php foreach($mobile_menu['ptk_sub_page'] as $ptk_sub_page){?>
                                    <li><a href="<?php echo $ptk_sub_page['ptk_sub_page_url']?>"><?php echo $ptk_sub_page['ptk_sub_page_title']?></a></li>
                                <?php }?>
                            </ul>
                        <?php }?>
                    </li>
                <?php }?>
            <?php }?>
            <!-- <li><a href="#">NEWS/EVENTI <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <li><a href="#">All Reviews</a></li>
                    <li><a href="#">Galleries</a></li>
                </ul>
            </li> -->
            <!-- <li><a href="#">AREA DOWNLOAD <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <li><a href="#">All Reviews</a></li>
                    <li><a href="#">Galleries</a></li>
                </ul>
            </li> -->
            <!-- <li><a href="#">CONTATTI <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <li><a href="#">All Reviews</a></li>
                    <li><a href="#">Galleries</a></li>
                </ul>
            </li>
            <li><a href="#">protek+design <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <li><a href="#">All Reviews</a></li>
                    <li><a href="#">Galleries</a></li>
                </ul>
            </li>
            <li><a href="#">AREA RISERVATA <i class="fa-regular fa-chevron-right"></i></a>
                <ul>
                    <li><a href="#">All Reviews</a></li>
                    <li><a href="#">Galleries</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>

<!-- sidebar section ends here  -->





