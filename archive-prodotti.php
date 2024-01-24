<?php

get_header();

?>

<?php 
    $categories = get_terms(

        array(
            'taxonomy'      => 'collezione',
            'parent'        => 0,
            'hide_empty'    => false
        ),
    );
    $is_left_product_active = 1;
 
?>

<main>

    <!-- breadcrumb section start from here  -->
    <section class="breadcrumb-main">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                    <div class="container">

                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">PROTEK HOME</a></li>



                                    <li class="breadcrumb-item active" aria-current="page"> PRODOTTI</li>

                                </ol>

                            </div>

                        </div>

                    </div>



                </nav>
            </section>
    

    <!-- breadcrumb section ends here  -->


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
        $category_bg_image      = get_template_directory_uri() . "/assets/images/tutti/tutti-banner.png";
        if ($category_bg_image_id) {
            $category_bg_image = wp_get_attachment_url($category_bg_image_id);
        }
        $category_link = get_term_link($category_id);
        
        if ($category_bg_color == '') {
            $category_bg_color = '#fff';
        }
        if ($category_title_color == '') {
            $category_title_color = '#000';
        }
        ?>
        <?php if($is_left_product_active == 1){?>
            <?php $is_left_product_active = 0; ?>
            <?php if(strpos($category_name, 'accessori') !== false){?>
                <div id="accessori" class="tutti-revers-main" style="background: #F1F0EC;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="image-box">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tutti/ttr.png" alt="ttr.png">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="tuttirevers-contentbox text-end">
                                    <h3>accessori</h3>
                                    <ul>
                                    <?php foreach($sub_categories as $sub_category){?>
                                        <?php 
                                            $sub_category_name  = $sub_category->name;    
                                            $sub_category_id    = $sub_category->term_id;
                                            // echo '<pre>';
                                            // print_r($sub_category_name);    
                                        ?>
                                        <li>
                                            <a href="#"><?php echo $sub_category_name?></a>
                                        </li>
                                    <?php }?>
                                        <!-- <li>
                                            <a href="#">per scorrevole - Classic</a>
                                        </li>
                                        <li>
                                            <a href="#">per scorrevole - linear</a>
                                        </li>
                                        <li>
                                            <a href="#">per battente</a>
                                        </li> -->
                                    </ul>
                                    <div class="scorpi-btn">
                                        <a href="<?php echo $category_link?>">
                                            scopri di più
                                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                                <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{?>
                <section id="#controtelai" class="tutti-controtelai-main" style="background:<?php echo $category_bg_color?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="tutti-image-box">
                                    <img src="<?php echo $category_bg_image;?>" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="tutti-contentbox">
                                    <h3><?php echo $category_name;?> </h3>
                                    <ul>
                                        <?php foreach($sub_categories as $sub_category){?>
                                            <?php 
                                                $sub_category_name  = $sub_category->name;    
                                                $sub_category_id    = $sub_category->term_id;
                                                $sub_sub_categories = get_terms(
                                                    array(
                                                        'taxonomy'      => 'collezione',
                                                        'parent'        => $sub_category_id,
                                                        'hide_empty'    => false
                                                    ),
                                                );
                                                $sub_sub_category_name  = isset($sub_sub_categories[0]) ? $sub_sub_categories[0]->name : '';
                                                $sub_sub_category_id    = isset($sub_sub_categories[0]) ? $sub_sub_categories[0]->term_id : '';
                                                // echo '<pre>';
                                                // print_r($sub_sub_categories);    
                                            ?>
                                        <li>
                                            <a href="<?php echo $category_link?>#<?php echo $sub_category->slug?>">
                                                <span> <?php echo $sub_category_name?> collection</span> <?php if($sub_sub_category_name != ''){?>- <?php echo $sub_sub_category_name?> <?php }?>
                                            </a>
                                        </li>
                                        
                                        <?php }?>
                                        <!-- <li>
                                            <a href="#">
                                                <span>linear collection</span> - Controtelai senza stipiti e coprifili e porte
                                                filo muro
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span>MAGIC BOX COLLECTION</span> - Controtelai predisposti per utenze e/o
                                                idriche
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span> skudo collection</span> - Controtelai in kit
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span>wallout</span> - Kit scorrevoli esterno muro
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span> outdoor collection</span> - Controtelai per esterno
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php }?>
        <?php }else{?>
            <?php $is_left_product_active = 1; ?>
            <?php if(strpos($category_name, 'accessori') !== false){?>
                <div id="accessori" class="tutti-revers-main"style="background:<?php echo $category_bg_color?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="image-box">
                                    <img src="<?php echo $category_bg_image;?>" alt="ttr.png">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="tuttirevers-contentbox text-end">
                                    <h3>accessori</h3>
                                    <ul>
                                    <?php foreach($sub_categories as $sub_category){?>
                                        <?php 
                                            $sub_category_name  = $sub_category->name;    
                                            $sub_category_id    = $sub_category->term_id;    
                                        ?>
                                    <li>
                                        <a href=""><?php echo $sub_category_name?></a>
                                    </li>
                                    <?php }?>
                                        <!-- <li>
                                            <a href="#">per scorrevole - Classic</a>
                                        </li>
                                        <li>
                                            <a href="#">per scorrevole - linear</a>
                                        </li>
                                        <li>
                                            <a href="#">per battente</a>
                                        </li> -->
                                    </ul>
                                    <div class="scorpi-btn">
                                        <a href="<?php echo $category_link?>">
                                            scopri di più
                                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                                <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{?>
                <section id="maniglie-e-serrature" class="serrature-main" style="background:<?php echo $category_bg_color?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="content-box">
                                    <h3><?php echo $category_name;?> </h3>
                                    <ul>
                                    <?php foreach($sub_categories as $sub_category){?>
                                        <?php 
                                            $sub_category_name  = $sub_category->name;    
                                            $sub_category_id    = $sub_category->term_id;  
                                        ?>
                                    <li>
                                        <a href="#"><?php echo $sub_category_name?></a>
                                    </li>
                                    <?php }?>
                                        <!-- <li>
                                            <a href="#">maniglie per scorrevole</a>
                                        </li>
                                        <li>
                                            <a href="#">serrature per scorrevole</a>
                                        </li>
                                        <li>
                                            <a href="#">serrature per scorrevole</a>
                                        </li> -->
                                    </ul>
                                    <div class="scorpi-btn">
                                        <a href="<?php echo $category_link?>">scopri di più</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="image-box">
                                    <img src="<?php echo $category_bg_image;?>" alt="serature.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php }?>
        <?php }?>
<?php }?> 

    <!-- controtelai section start from here  -->

    
    <!-- controtelai section start from here  -->

    <!-- serrature section start from here  -->
    
    <!-- serrature section ends here  -->

    <!-- tutti revers start from here  -->
    <!-- <div id="accessori" class="tutti-revers-main" style="background: #F1F0EC;">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="image-box">

                        <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/tutti/ttr.png" alt="ttr.png">

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="tuttirevers-contentbox text-end">

                        <h3>accessori</h3>

                        <ul>

                            <li>

                                <a href="#">per scorrevole - Classic</a>

                            </li>

                            <li>

                                <a href="#">per scorrevole - linear</a>

                            </li>

                            <li>

                                <a href="#">per battente</a>

                            </li>

                        </ul>

                        <div class="scorpi-btn">

                            <a href="#">

                                scopri di più

                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">

                                    <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black"></path>

                                </svg>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div> -->
    <!-- tutti revers start from here  -->

    <!-- tutti revers start from here  -->
    <div class="tutti-revers-main" style="background: #fff;">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-5">

                    <div class="tuttirevers-contentbox">

                        <h3>CATALOGO PRODOTTI 2023 </h3>

                        <p>Scarica il catalogo completo di tutti i nostri prodotti</p>



                        <div class=" tutti-download-box">

                            <div class="download-file">



                                <div class="single-file">

                                    <a href="#" target="_blank">

                                        <div class="download-flex">

                                            <div class="file-name">ISTRUZIONI MONTAGGIO INTONACO

                                            </div>

                                            <div class="file-type">

                                                zip <span>229 kb</span>

                                            </div>

                                            <div class="download-icon">

                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="single-file">

                                    <a href="#" target="_blank">

                                        <div class="download-flex">

                                            <div class="file-name">ISTRUZIONI MONTAGGIO CARTONGESSO

                                            </div>

                                            <div class="file-type">

                                                zip <span>229 kb</span>

                                            </div>

                                            <div class="download-icon">

                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 d-none d-md-block d-lg-block"></div>



                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">

                    <div class="image-box">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tutti/ttr2.png" alt="ttr2.png">

                    </div>

                </div>



            </div>

        </div>

    </div>
    <!-- tutti revers start from here  -->
</main>

<?php

get_footer();

?>