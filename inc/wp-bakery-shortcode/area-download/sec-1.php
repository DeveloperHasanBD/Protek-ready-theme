<?php

add_action('vc_before_init', 'redp_adownload_sec_1_backend');

function redp_adownload_sec_1_backend()

{

    vc_map(

        array(

            "name"          => __("Area Download", "redapple"), // Element name

            "base"          => "redp_adownload_sec_1", // Element shortcode

            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',

            'description'   => 'Dedicated for redapple',

            "class"         => "redapple-cstm",

            "category"      => __('Area Download', 'redapple'),

            "params"        => array(

                // array(

                //     "type"          => "textfield",

                //     "heading"       => "Protek Title",

                //     "param_name"    => "ptk_d_s1_title",

                // ),

            ),

        )

    );

}



add_shortcode('redp_adownload_sec_1', 'redp_adownload_sec_1_view');



function redp_adownload_sec_1_view($atts)



{

    ob_start();

    $atts = shortcode_atts(array(

        'home_main_slider'     => '',

    ), $atts, 'redp_adownload_sec_1');


    if(isset($_GET['ad'])){

        $fileUrls = array(
            'https://protek.dominiotest.ch/wp-content/uploads/2023/12/Test-Five.pdf',
            'https://protek.dominiotest.ch/wp-content/uploads/2023/12/Test-One.pdf',
            'https://protek.dominiotest.ch/wp-content/uploads/2023/12/Test-Four.pdf',
            // Add more URLs as needed
        );
        // Directory to store downloaded files
        $downloadDir = 'downloads';

        // Ensure the download directory exists
        if (!file_exists($downloadDir)) {
            mkdir($downloadDir, 0777, true);
        }

        // Download files
        $downloadedFiles = [];
        foreach ($fileUrls as $url) {
            $filename = $downloadDir . '/' . basename($url);
            $fileContent = file_get_contents($url);
            file_put_contents($filename, $fileContent);
            $downloadedFiles[] = $filename;
            
        }
        
        // Create zip archive
        $zipName = 'output.zip';
        $zip = new ZipArchive();
    
        if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
            foreach ($downloadedFiles as $file) {
                $filename = basename($file);
                $zip->addFile($file, $filename);
            }
            $zip->close();
            echo 'Zip archive created successfully: ' . $zipName;
        } else {
            echo 'Failed to create zip archive';
        }
    }
    // $slide_items = vc_param_group_parse_atts($atts['home_main_slider']);
    $page_area_id       = get_the_ID();
    $area_categories    = get_terms(
            array(
                'taxonomy'      => 'collezione',
                'parent'        => 44,
                'hide_empty'    => false
            ),
        );

    $prodotti_download_options         = get_field('prodotti_download_options',53);
    // echo '<pre>';
    // print_r($area_categories);
?>

    <!-- breadcrumb section start from here  -->

    <section class="breadcrumb-main">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="#">PROTEK HOME</a></li>



                            <li class="breadcrumb-item active" aria-current="page"> Area download</li>

                        </ol>

                    </div>

                </div>

            </div>



        </nav>

    </section>

    <!-- breadcrumb section ends here  -->

    <!-- avanzata banner start from here  -->

    <section class="avanzata-banner-main areadownload-banner">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <h2>Area Download</h2>

                    <p>QUI PUOI TROVARE TUTTE LE SCHEDE TECNICHE, LE ISTRUZIONI DI MONTAGGIO E TUTTO CIò CHE TI

                        SERVE PER IL TUO PROGETTO. <br>

                        CERCA IL PRODOTTO CHE TI SERVE E SCARICA TUTTA LA DOCUMENTAZIONE. </p>

                </div>

            </div>

        </div>

    </section>

    <!-- avanzata banner end here  -->

    <!-- aread filter start from here  -->

    <section class="area-filter-main">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="area-filter-search">

                        <div class="form-group">

                            <button>

                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20" fill="none">

                                    <g clip-path="url(#clip0_274_2473)">

                                        <path d="M7.037 0C10.9209 0 14.0739 3.0829 14.0739 6.88048C14.0739 9.38409 12.7006 11.5792 10.6553 12.7822L14.9479 19.636C15.0296 19.7292 15.016 19.869 14.9206 19.9489C14.8253 20.0289 14.6823 20.0155 14.6006 19.9223C14.5869 19.9046 14.5733 19.8868 14.5642 19.8646L10.2581 13.0041C9.29336 13.4902 8.19696 13.761 7.037 13.761C3.15307 13.761 7.82013e-05 10.6781 7.82013e-05 6.88048C7.82013e-05 3.0829 3.15307 0 7.037 0ZM7.037 0.443902C3.39823 0.443902 0.454073 3.32261 0.454073 6.88048C0.454073 10.4384 3.39823 13.3171 7.037 13.3171C10.6758 13.3171 13.6199 10.4384 13.6199 6.88048C13.6199 3.32261 10.6758 0.443902 7.037 0.443902Z" fill="black" />

                                    </g>

                                    <defs>

                                        <clipPath id="clip0_274_2473">

                                            <rect width="15" height="20" transform="matrix(-1 0 0 1 15 0)" fill="white" />

                                        </clipPath>

                                    </defs>

                                </svg>

                            </button>

                            <input type="text" class="form-control" id="serching_product" placeholder="CERCA">
                            <!-- <a class="btn btn-primary btn-sm" href="<?php echo site_url()?>/area-download/?ad=true ">Click</a> -->


                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    <div class="area-selectbox">
                        <select class="js-example-basic-single" id="area_download_caategories" name="cellezione">
                            <option value="">collezione</option>
                            <?php foreach($area_categories as $area_category){?>
                                <option value="<?php echo $area_category->term_id?>"><?php echo $area_category->name?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    <div class="area-selectbox">
                        <select class="js-example-basic-single" id="area_download_sub_category" name="cataloghi">
                            <option value="">cataloghi</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    <div class="area-selectbox">
                        <select class="js-example-basic-single" id="area_download_products" name="prodotto">
                            <option value="">prodotto</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- aread filter end here  -->



    <!-- area collection section start from here  -->
    <?php
    $category_products  = array();
    $area_category_name = '';
    $area_category_id   = '';
    foreach($area_categories as $area_category){
        $product_arg = array(
            'post_type' => 'prodotti',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'collezione',
                    'field'     => 'term_id',
                    'terms'     => $area_category->term_id,
                ),
            ),
        );
        $product_query = new WP_Query($product_arg);
        if ($product_query->have_posts()) { 
            $category_products = $product_query->posts;
            $area_category_name = $area_category->name;
            $area_category_id   = $area_category->term_id;
            break;
        }
    }
    ?>
    <?php if(count($category_products) > 0){?>

        <?php 
            $area_download_sub_categories = get_terms(
                                                array(
                                                    'taxonomy'      => 'collezione',
                                                    'parent'        => $area_category_id,
                                                    'hide_empty'    => false
                                                ),
                                            ); 
            
            // echo '<pre>';
            // print_r($area_download_sub_categories);
        ?>
        <section class="area-collection-main" id="area_download_section">
            <?php foreach($area_download_sub_categories as $area_download_sub_category){?>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="collection-title">
                                <h5><?php echo $area_category_name ?> COLLECTION </h5>
                                <h3><?php echo $area_download_sub_category->name ?> </h3>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $ad_sub_cat_product_arg = array(
                            'post_type' => 'prodotti',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'collezione',
                                    'field'     => 'term_id',
                                    'terms'     => $area_download_sub_category->term_id,
                                ),
                            ),
                        );
                        $ad_sub_cat_product_query = new WP_Query($ad_sub_cat_product_arg);
                        
                    ?>
                    <?php if ($ad_sub_cat_product_query->have_posts()) { ?>
                        <?php while ($ad_sub_cat_product_query->have_posts()) { ?>
                            <?php 
                                $ad_sub_cat_product_query->the_post();
                                $area_d_post_id         = get_the_ID();
                                $area_d_post_title      = get_the_title();  
                                $are_short_description  = get_field('pkt_short_description'); 
                                $prodotti_download_options = get_field('prodotti_download_options',$area_d_post_id);
                            ?>
                            <?php if($prodotti_download_options){?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="area-download-bg">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="areabg-titlebox">
                                                        <h4><?php echo $area_d_post_title;?></h4>
                                                        <h5><?php echo $are_short_description;?></h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-between">
                                                <?php foreach($prodotti_download_options as $prodotti_download_option){?>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                        <div class="download-file">
                                                            <h6><?php echo $prodotti_download_option['title']?></h6>
                                                            <?php foreach($prodotti_download_option['files'] as $prodotti_download_option_file){?>
                                                                <?php
                                                                    // echo '<pre>';
                                                                    // print_r($prodotti_download_option_file);
                                                                ?>
                                                                <div class="single-file">
                                                                    <a href="<?php echo $prodotti_download_option_file['file_item']['url']?>" download>
                                                                        <div class="download-flex">
                                                                            <div class="file-name"><?php echo $prodotti_download_option_file['file_item']['title']?></div>
                                                                            <div class="file-type" style="min-width:100px;">
                                                                            <?php echo $prodotti_download_option_file['file_item']['subtype']?> <span><?php echo $prodotti_download_option_file['file_item']['filesize']?> kb</span>
                                                                            </div>
                                                                            <div class="download-icon">
                                                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                    <div class="download-file">
                                                        <h6>CARTONGESSO</h6>
                                                        <div class="single-file">
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

                                                        <div class="single-file">

                                                            <a href="#" target="_blank">

                                                                <div class="download-flex">

                                                                    <div class="file-name">ISTRUZIONI DI MONTAGGIO CARTONGESSO</div>

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

                                                </div> -->
                                            </div>
                                            <div class="row justify-content-between">

                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 d-none d-lg-block"></div>

                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

                                                    <div class="download-file">

                                                        <div class="single-file">

                                                            <a href="#" target="_blank">

                                                                <div class="download-flex">

                                                                    <div class="file-name">SCARICA TUTTA LA DOCUMENTAZIONE </div>

                                                                    <div class="file-type">

                                                                        <span></span>

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

                                    </div>
                                </div>
                            <?php }?>
                        <?php }wp_reset_postdata();?>
                    <?php }?>
                </div>
            <?php }?>
        </section>
    <?php }?>
    <!-- area collection section ends here  -->

<?php



    $result = ob_get_clean();



    return $result;

}

