<?php
add_action('vc_before_init', 'redp_home_sec_5_backend');
function redp_home_sec_5_backend()
{

    vc_map(
        array(
            "name"          => __("Progettazione", "redapple"), // Element name
            "base"          => "redp_home_sec_5", // Element shortcode
            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description'   => 'Dedicated for redapple',
            "class"         => "redapple-cstm",
            "category"      => __('Home', 'redapple'),
            "params" => array(
                array(
                    "type"          => "textfield",
                    "heading"       => "Title",
                    "param_name"    => "ptk_s5_title",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => "Left image",
                    "param_name"    => "ptk_s5_left_img",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => "Bottom Title",
                    "param_name"    => "ptk_s5_btm_title",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => "Samll Logo",
                    "param_name"    => "ptk_s5_sml_logo",
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => "Description",
                    "param_name"    => "ptk_s5_desc",
                ),
                array(
                    "type"          => "vc_link",
                    "heading"       => "URL",
                    "param_name"    => "ptk_s5_url",
                ),
            ),
        )
    );
}


add_shortcode('redp_home_sec_5', 'redp_home_sec_5_view');

function redp_home_sec_5_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'ptk_s5_title'          => '',
        'ptk_s5_left_img'       => '',
        'ptk_s5_btm_title'      => '',
        'ptk_s5_sml_logo'       => '',
        'ptk_s5_desc'           => '',
        'ptk_s5_url'            => '',
    ), $atts, 'redp_home_sec_5');

    $ptk_s5_title           = $atts['ptk_s5_title'] ?? '';

    $ptk_s5_left_img_id     = $atts['ptk_s5_left_img'] ?? '';
    $ptk_s5_left_img_url    = wp_get_attachment_image_url($ptk_s5_left_img_id, 'full');

    $ptk_s5_btm_title       = $atts['ptk_s5_btm_title'] ?? '';

    $ptk_s5_sml_logo_id     = $atts['ptk_s5_sml_logo'] ?? '';
    $ptk_s5_sml_logo_url    = wp_get_attachment_image_url($ptk_s5_sml_logo_id, 'full');

    $ptk_s5_desc            = $atts['ptk_s5_desc'] ?? '';

    $ptk_s5_url_dtls        = vc_build_link($atts['ptk_s5_url']) ?? '';
    $ptk_s5_url             = $ptk_s5_url_dtls['url'] ?? '';
    $ptk_s5_url_title       = $ptk_s5_url_dtls['title'] ?? '';
?>


    <!-- progettazione section start from here  -->
    <section class="progettazione-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="image-box">
                        <img src="<?php echo $ptk_s5_left_img_url; ?>" alt="progettazione.png">
                    </div>
                    <div class="bim-flex">
                        <div class="text-box">
                            <h5><?php echo $ptk_s5_btm_title; ?></h5>
                        </div>
                        <div class="icon-box">
                            <img src="<?php echo $ptk_s5_sml_logo_url; ?>" alt="bim.png">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 d-none d-md-block d-lg-block"></div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="progettazione-details">
                        <div class="home-common-title">
                            <h2><?php echo $ptk_s5_title; ?></h2>
                        </div>
                        <div class="about-progettazione">
                            <p><?php echo $ptk_s5_desc; ?></p>
                        </div>
                        <div class="scorpi-btn">
                            <a href="<?php echo $ptk_s5_url; ?>">
                                <?php
                                if ($ptk_s5_url_title) {
                                    echo $ptk_s5_url_title;
                                } else {
                                    echo 'vai alla ricerca avanzata';
                                }
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                    <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- progettazione section start from here  -->
    
<?php

    $result = ob_get_clean();

    return $result;
}
