<?php

$single_post_id     = get_the_ID();
$single_post_title  = get_the_title();

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
    <!-- breadcrumb section ends here  -->

    <?php
    $categories             = wp_get_object_terms($single_post_id, 'collezione');
    $post_category          = isset($categories[0]) ? $categories[0] : '';
    $post_sub_category      = isset($categories[1]) ? $categories[1] : '';
    $post_category_name     = isset($post_category->name) ? $post_category->name : '';
    $post_category_id       = isset($post_category->term_id) ? $post_category->term_id : '';
    $post_sub_category_name = isset($post_sub_category->name) ? $post_sub_category->name : '';
    $post_sub_category_id   = isset($post_sub_category->term_id) ? $post_sub_category->term_id : '';
    $shot_description       = get_field('pkt_short_description', $single_post_id);
    $banner_image_one       = get_field('prodotti_banner_image_one', $single_post_id);
    $banner_image_two       = get_field('prodotti_banner_image_two', $single_post_id);
    $prodotti_loader        = get_field('prodotti_loader_image', $single_post_id);
    $description            = get_field('prodotti_description', $single_post_id);
    $certificazioni         = get_field('prodotti_certificazioni', $single_post_id);
    
    $e_consulenze           = get_field('informazioni_e_consulenze', 'option');
    $e_consulenze_description = get_field('informazioni_e_consulenze_description', 'option');
    $e_consulenze_icon      = get_field('informazioni_e_consulenze_icon', 'option');

    $kdiem_title            = get_field('kdiem_title', $single_post_id);
    $kdiem_note             = get_field('kdiem_note', $single_post_id);
    $kdiem_video            = get_field('kdiem_video', $single_post_id);
    $kdiem_files            = get_field('kdiem_files', $single_post_id);
    $kit_di_progettazione   = get_field('kit_di_progettazione', $single_post_id);
    $prodotti_download_options         = get_field('prodotti_download_options', $single_post_id);

    // echo '<pre>';
    // print_r($kdiem_files);
    // print_r($kdiem_note);
    // print_r($kdiem_video);
    // print_r($kdiem_files);
    // print_r($single_post_id);

    $related_products = array();
    $related_products_query = '';
    if ($post_category_id) {
        $related_products_args = array(
            'post_type' => 'prodotti',
            'tax_query' => array(
                array(
                    'taxonomy' => 'collezione',
                    'field' => 'term_id',
                    'terms' => $post_category_id,
                ),
            ),
        );
        $related_products_query = new WP_Query($related_products_args);
        $related_products = $related_products_query->posts;
        // echo '<pre>';
        // print_r($related_products);
        // die;
    }
    ?>


    <!-- prodotti common banner start from here  -->
    <section class="accessori-banner-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="banner-contentbox">

                        <div class="titlebox">

                            <h5><?php echo $post_sub_category_name; ?></h5>

                            <h2><?php echo $single_post_title; ?><span> <?php echo $post_category_name; ?> collection</span></h2>

                            <p><?php echo $shot_description ?></p>

                        </div>

                        <ul>

                            <li>

                                <a href="#">

                                    <i class="fa-light fa-share-nodes"></i>

                                    condividi

                                </a>

                            </li>

                            <li>

                                <a href="#">

                                    <i class="fa-sharp fa-light fa-circle-info"></i>

                                    richiedi informazioni

                                </a>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="banner-image-box">

                        <?php if ($banner_image_one) { ?>
                            <img src="<?php echo $banner_image_one; ?>" alt="<?php echo $single_post_title; ?>">
                        <?php } ?>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="banner-image-box">

                        <?php if ($banner_image_two) { ?>
                            <img src="<?php echo $banner_image_two; ?>" alt="<?php echo $single_post_title; ?>">
                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- prodotti common banner ends here  -->



    <!-- product certficazione section start from here  -->



    <section class="productcertificate-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

                    <div class="certifica-descriptionbox">
                        <?php echo $description; ?>
                        <!-- <h5>È il controtelaio standard predisposto per lo scorrimento a scomparsa di un’anta

                            scorrevole, ideale per eliminare tutti i problemi di spazio e per arredare con vero

                            stile la tua casa.</h5>

                        <p>Il controtelaio singolo per pareti da intonaco e cartongesso è disponibile nelle seguenti

                            misure:</p>

                        <ul>

                            <li>da 300 a 1500 mm in larghezza </li>

                            <li>da 500 a 3000 mm in altezza</li>

                        </ul>

                        <p>Le misure intermedie disponibili vanno di 50 in 50 mm.</p> -->

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>

                <div class="col-xs-12 col-sm-12 col-md-6  col-lg-6 ">

                    <div class="certifca-gifbox">
                        <?php if ($prodotti_loader) { ?>
                            <img src="<?php echo $prodotti_loader ?>" alt="">
                        <?php } ?>
                    </div>

                    <div class="allcertificate-image-box">

                        <p>Certificazioni</p>
                        <div class="certifca-image-box">
                            <?php foreach ($certificazioni as $single_image) { ?>
                                <div class="single-image">
                                    <img src="<?php echo $single_image['image']; ?>" alt="">
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- product certficazione section ends here  -->



    <!-- product tabs start from here  -->

    <section class="product-tabs-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="product-tabs-bg">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">

                                <button class="nav-link active" id="progettazione-tab" data-bs-toggle="tab" data-bs-target="#progettazione-tab-pane" type="button" role="tab" aria-controls="progettazione-tab-pane" aria-selected="true">KIT DI

                                    PROGETTAZIONE</button>

                            </li>

                            <li class="nav-item" role="presentation">

                                <button class="nav-link" id="installazione-tab" data-bs-toggle="tab" data-bs-target="#installazione-tab-pane" type="button" role="tab" aria-controls="installazione-tab-pane" aria-selected="false">KIT DI INSTALLAZIONE E

                                    MONTAGGIO</button>

                            </li>

                            <li class="nav-item" role="presentation">

                                <button class="nav-link" id="accessori-tab" data-bs-toggle="tab" data-bs-target="#accessori-tab-pane" type="button" role="tab" aria-controls="accessori-tab-pane" aria-selected="false">ACCESSORI

                                    CONSIGLIATI</button>

                            </li>



                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="progettazione-tab-pane" role="tabpanel" aria-labelledby="progettazione-tab" tabindex="0">

                                <div class="row">
                                    <?php if($kit_di_progettazione){?>
                                        <?php foreach($kit_di_progettazione as $pro_item){?>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                                <div class="product-download-box">

                                                    <div class="download-file">

                                                        <h6><?php echo $pro_item['kit_title']?></h6>
                                                        <?php if(isset($pro_item['file'])){?>
                                                            <?php foreach($pro_item['file'] as $pro_file){?>
                                                                <div class="single-file">

                                                                    <a href="<?php echo $pro_file['file_item']['url']?>" download>

                                                                        <div class="download-flex">

                                                                            <div class="file-name"><?php echo $pro_file['file_item']['title']?> </div>

                                                                            <div class="file-type" style="min-width: 100px;">

                                                                            <?php echo $pro_file['file_item']['subtype']?> <span><?php echo $pro_file['file_item']['filesize']?> kb</span>

                                                                            </div>

                                                                            <div class="download-icon">

                                                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                                                            </div>

                                                                        </div>

                                                                    </a>

                                                                </div>
                                                            <?php }?>
                                                        <?php }?>
                                                        <!-- <div class="single-file">

                                                            <a href="#" target="_blank">

                                                                <div class="download-flex">

                                                                    <div class="file-name">BIM CARTONGESSO </div>

                                                                    <div class="file-type">

                                                                        zip <span>229 kb</span>

                                                                    </div>

                                                                    <div class="download-icon">

                                                                        <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                                                    </div>

                                                                </div>

                                                            </a>

                                                        </div> -->

                                                    </div>

                                                </div>

                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                        <div class="product-download-box">

                                            <div class="download-file">

                                                <h6>SCHEDE TECNICHE </h6>

                                                <div class="single-file">

                                                    <a href="#" target="_blank">

                                                        <div class="download-flex">

                                                            <div class="file-name">SCHEDA TECNICA INTONACO </div>

                                                            <div class="file-type">

                                                                pdf <span>229 kb</span>

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

                                                            <div class="file-name">SCHEDA TECNICA CARTONGESSO </div>

                                                            <div class="file-type">

                                                                pdf <span>229 kb</span>

                                                            </div>

                                                            <div class="download-icon">

                                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                                            </div>

                                                        </div>

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div> -->

                                    <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                        <div class="product-download-box">

                                            <div class="download-file">

                                                <h6>Libreria CAD </h6>

                                                <div class="single-file">

                                                    <a href="#" target="_blank">

                                                        <div class="download-flex">

                                                            <div class="file-name">DWG INTONACO </div>

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

                                                            <div class="file-name">DWG CARTONGESSO </div>

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

                                    </div> -->

                                </div>

                            </div>

                            <div class="tab-pane fade" id="installazione-tab-pane" role="tabpanel" aria-labelledby="installazione-tab" tabindex="0">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                        <div class="montaggio-box">

                                            <h3><?php echo $kdiem_title?></h3>



                                            <div class="video-box">
                                                <?php if(isset($kdiem_video['url'])){?>
                                                <video loop controls id="productVideo">

                                                    <source src="<?php echo $kdiem_video['url']?>" type="<?php $kdiem_video['mime_type']?>">

                                                </video>
                                                <div class="video-playbtn">
                                                    <button id="playPauseButton" class="paused">
                                                        <i class="fa-solid fa-play"></i>
                                                    </button>
                                                </div>
                                                <?php }?>
                                                

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                        <div class="montaggio-contentbox">

                                            <div class="product-download-box">

                                                <div class="download-file">

                                                    <h6><?php echo $kdiem_title?></h6>
                                                    <?php if(isset($kdiem_files[0]['kdiem_file_item'])){?>
                                                        <?php foreach($kdiem_files as $kdiem_file){?>
                                                            <div class="single-file">

                                                                <a href="<?php echo $kdiem_file['kdiem_file_item']['url']?>" download>

                                                                    <div class="download-flex">

                                                                        <div class="file-name"><?php echo $kdiem_file['kdiem_file_item']['title']?>

                                                                        </div>

                                                                        <div class="file-type" style="min-width: 100px;">

                                                                        <?php echo $kdiem_file['kdiem_file_item']['subtype']?> <span><?php echo $kdiem_file['kdiem_file_item']['filesize']?> kb</span>

                                                                        </div>

                                                                        <div class="download-icon">

                                                                            <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>

                                                                        </div>

                                                                    </div>

                                                                </a>

                                                            </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <!-- <div class="single-file">

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

                                                    </div> -->

                                                </div>

                                            </div>

                                            <div class="notebox">
                                                <?php if($kdiem_note){?>
                                                    <h5>note</h5>
                                                    <p><?php echo $kdiem_note?></p>
                                                <?php }?>
                                                <p>

                                                    <strong>HAI BISOGNO DI SUPPORTO PER L’INSTALLAZIONE? IL NOSTRO STAFF

                                                        è SEMPRE A TUA DISPOSIZIONE PER RISPONDERE ALLE TUE

                                                        DOMANDE</strong>

                                                </p>

                                            </div>

                                            <div class="button-box">

                                                <a href="<?php echo site_url()?>/contatti">CONTATTACI</a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade" id="accessori-tab-pane" role="tabpanel" aria-labelledby="accessori-tab" tabindex="0">

                                <div class="consigliati-box">



                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                            <ul>

                                                <li>

                                                    <a href="#">Kit Lifty System®</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit carrello 150 Kg</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit chiusura ammortizzata</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit coprifilo singolo</a>

                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                            <ul>

                                                <li>

                                                    <a href="#">Kit maniglie</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit maniglie porte vetro</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit maniglioni</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit monopinza vetro</a>

                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                            <ul>

                                                <li>

                                                    <a href="#">Kit motorizzazione (integrato)</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit motorizzazione (non integrato)</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit pinza vetro grande</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit pinza vetro piccola</a>

                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                            <ul>

                                                <li>

                                                    <a href="#">Kit scatoletta elettrica</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit scorrimento facile</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit serrature</a>

                                                </li>

                                                <li>

                                                    <a href="#">Kit stipiti singolo</a>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>



                        </div>
                    </div>


                </div>

            </div>

        </div>

    </section>



    <!-- product tabs start from here  -->



    <!-- informazioni section start from here  -->

    <section class="informazioni-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 d-none d-md-block d-lg-block"></div>

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                    <div class="informazioni-title">

                        <div class="icon-box">
                            <?php if ($e_consulenze_icon) { ?>
                                <img src="<?php echo $e_consulenze_icon; ?>" alt="">
                            <?php } ?>
                        </div>

                        <h3><?php echo $e_consulenze ?></h3>

                    </div>

                    <div class="informazioni-description">
                        <?php echo $e_consulenze_description ?>
                    </div>

                    <div class="button-box">
                        <a href="<?php echo site_url(); ?>/contatti/">contattaci</a>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 d-none d-md-block d-lg-block"></div>

            </div>

        </div>

    </section>



    <!-- informazioni section ends here  -->



    <!-- prodotti correlati section start from here  -->

    <section class="prodotti-correlati-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="title-box">

                        <h3>prodotti correlati</h3>

                    </div>

                </div>

            </div>

            <div class="row">
                <?php if (count($related_products) > 0) { ?>
                    <?php while ($related_products_query->have_posts()) { ?>
                        <?php
                        $related_products_query->the_post();
                        $rel_single_post_id        = get_the_ID();
                        $product_url    = get_the_permalink();
                        $image_url      = site_url() . '/wp-content/uploads/2023/12/default.png';
                        if (has_post_thumbnail()) {
                            $image_url = get_the_post_thumbnail_url($rel_single_post_id);
                        }

                        $pkt_short_description  = get_field('pkt_short_description');
                        $rel_post_title             = get_the_title();
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                            <div class="common-single-collection">
                                <a href="<?php echo $product_url ?>">
                                    <div class="image-box">

                                        <img src="<?php echo $image_url; ?>" alt="">

                                        <div class="content-box">
                                            <div class="content">
                                                <p><?php echo $pkt_short_description ?></p>
                                                <h5>
                                                    <a href="<?php echo $product_url ?>"><?php echo $rel_post_title ?></a>
                                                </h5>
                                            </div>

                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>

        </div>

    </section>





    <!-- prodotti correlati section ends here  -->



</main>

<?php



get_footer();
