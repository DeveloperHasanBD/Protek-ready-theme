<?php
add_action('vc_before_init', 'redp_home_sec_3_backend');
function redp_home_sec_3_backend()
{



    $collec_terms = get_terms(array(
        'taxonomy'   => 'collezione',
        'hide_empty' => false,
        'parent'     => 0
    ));

    $total_collec       = count($collec_terms);
    $collection_terms   = [];
    $collection_terms['Choose main category'] = 'yes';
    if ($total_collec > 0) {
        foreach ($collec_terms as $single_term) {
            $collec_term_id                     = $single_term->term_id ?? '';
            $collec_name                        = $single_term->name ?? '';
            $collection_terms[$collec_name]     = $collec_term_id;
        }
    }

    vc_map(
        array(
            "name"          => __("Prodotti", "redapple"), // Element name
            "base"          => "redp_home_sec_3", // Element shortcode
            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description'   => 'Dedicated for redapple',
            "class"         => "redapple-cstm",
            "category"      => __('Home', 'redapple'),
            "params" => array(
                array(
                    "type"          => "textfield",
                    "heading"       => "Prodotti Title",
                    "param_name"    => "ptk_s3_title",
                ),
                array(
                    "type"          => "param_group",
                    "heading"       => "Choose prodotti main category",
                    "param_name"    => "ptk_s3_main_cat",
                    "value"         => "",
                    "params" => array(
                        array(
                            "type"                      => "dropdown",
                            "heading"                   => "Choose category name",
                            "param_name"                => "ptk_s3_choose_cat",
                            "value"                     => $collection_terms,
                        ),
                    ),
                ),
                array(
                    "type"          => "vc_link",
                    "heading"       => "URL",
                    "param_name"    => "ptk_s3_term_url",
                ),
            ),
        )
    );
}


add_shortcode('redp_home_sec_3', 'redp_home_sec_3_view');

function redp_home_sec_3_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'ptk_s3_title'          => '',
        'ptk_s3_main_cat'       => '',
        'ptk_s3_term_url'       => '',
    ), $atts, 'redp_home_sec_3');

    $ptk_s3_title           = $atts['ptk_s3_title'] ?? '';
    $ptk_s3_main_terms      = vc_param_group_parse_atts($atts['ptk_s3_main_cat']);
    $ptk_s3_url_dtls        = vc_build_link($atts['ptk_s3_term_url']) ?? '';
    $ptk_s3_url             = $ptk_s3_url_dtls['url'] ?? '';
    $ptk_s3_url_title       = $ptk_s3_url_dtls['title'] ?? '';

?>

    <!-- home prodotti start from here  -->
    <section class="home-prodotti-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="prodotti-image-box display_term_img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/prodotti.png" alt="">
                        <div class="category-tag display_term_name">
                            <a href=""></a>
                            Controtelai
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 d-none d-md-block d-lg-block"></div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pe-0">
                    <div class="home-common-title">
                        <h2><?php echo $ptk_s3_title; ?></h2>
                    </div>
                    <div class="pordotti-category">
                        <ul>
                            <?php
                            $inc = 1;
                            foreach ($ptk_s3_main_terms as $single_term) {
                                if ($single_term['ptk_s3_choose_cat'] !== 'yes') {
                                    $term_details       = get_term($single_term['ptk_s3_choose_cat']);
                                    $term_name          = $term_details->name ?? '';
                                    $term_slug          = $term_details->slug ?? '';
                                    $term_id            = intval($single_term['ptk_s3_choose_cat']) ?? '';
                                    $term_url           = get_term_link($term_id);
                                    $active_term_class  = '';

                                    if ($inc == 1) {
                                        $active_term_class = 'active';
                                    }
                            ?>
                                    <li>
                                        <a href="<?php echo $term_url; ?>" term_id="<?php echo $term_id; ?>" class="sec3_term_filter <?php echo $active_term_class; ?>">
                                            <?php echo $term_name; ?>
                                        </a>
                                    </li>
                            <?php
                                    $inc++;
                                }
                            }

                            ?>
                        </ul>
                        <div class="scorpi-btn">
                            <a href="<?php echo $ptk_s3_url; ?>">
                                <?php
                                if ($ptk_s3_url_title) {
                                    echo $ptk_s3_url_title;
                                } else {
                                    echo 'scopri di più';
                                }
                                ?>
                                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/arrow-extralong.png " alt=""> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                    <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home prodotti ends here  -->

<?php

    $result = ob_get_clean();

    return $result;
}
