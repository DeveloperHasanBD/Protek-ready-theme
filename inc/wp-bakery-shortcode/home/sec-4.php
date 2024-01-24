<?php
add_action('vc_before_init', 'redp_home_sec_4_backend');
function redp_home_sec_4_backend()
{

    vc_map(
        array(
            "name"          => __("Protek Design", "redapple"), // Element name
            "base"          => "redp_home_sec_4", // Element shortcode
            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description'   => 'Dedicated for redapple',
            "class"         => "redapple-cstm",
            "category"      => __('Home', 'redapple'),
            "params" => array(
                array(
                    "type"          => "attach_image",
                    "heading"       => "Protek Logo",
                    "param_name"    => "ptk_s4_logo",
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => "Description",
                    "param_name"    => "ptk_s4_desc",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => "Right image 1",
                    "param_name"    => "ptk_s4_right_img_1",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => "Right image 2",
                    "param_name"    => "ptk_s4_right_img_2",
                ),
                array(
                    "type"          => "vc_link",
                    "heading"       => "URL",
                    "param_name"    => "ptk_s4_url",
                ),
            ),
        )
    );
}


add_shortcode('redp_home_sec_4', 'redp_home_sec_4_view');

function redp_home_sec_4_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'ptk_s4_logo'                   => '',
        'ptk_s4_desc'                   => '',
        'ptk_s4_url'                    => '',
        'ptk_s4_right_img_1'            => '',
        'ptk_s4_right_img_2'            => '',
    ), $atts, 'redp_home_sec_4');

    $ptk_s4_logo_id             = $atts['ptk_s4_logo'] ?? '';
    $ptk_s4_logo_url            = wp_get_attachment_image_url($ptk_s4_logo_id, 'full');

    $ptk_s4_desc                = $atts['ptk_s4_desc'] ?? '';

    $ptk_s4_right_img_1_id      = $atts['ptk_s4_right_img_1'] ?? '';
    $ptk_s4_right_img_1_url     = wp_get_attachment_image_url($ptk_s4_right_img_1_id, 'full');

    $ptk_s4_right_img_2_id      = $atts['ptk_s4_right_img_2'] ?? '';
    $ptk_s4_right_img_2_url     = wp_get_attachment_image_url($ptk_s4_right_img_2_id, 'full');

    $ptk_s4_url_dtls            = vc_build_link($atts['ptk_s4_url']) ?? '';
    $ptk_s4_url                 = $ptk_s4_url_dtls['url'] ?? '';
    $ptk_s4_url_title           = $ptk_s4_url_dtls['title'] ?? '';
?>

    <!-- protek design start from here  -->
    <section class="protekdesign-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                    <div class="about-protek-design">
                        <div class="protek-desingn-logo">
                            <img src="<?php echo $ptk_s4_logo_url; ?>" alt="protekdesing.png">
                        </div>
                        <div class="about-design">
                            <p><?php echo $ptk_s4_desc; ?></p>
                        </div>
                        <div class="scorpi-btn">
                            <a href="<?php echo $ptk_s4_url; ?>">
                                <?php
                                if ($ptk_s4_url_title) {
                                    echo $ptk_s4_url_title;
                                } else {
                                ?>
                                    scopri la linea <strong>PROTEK DESIGN</strong>
                                <?php
                                }
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                    <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 d-none d-lg-block"></div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 px-0">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="desing-image-box">
                                <img src="<?php echo $ptk_s4_right_img_1_url; ?>" alt="d1.png">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="desing-image-box">
                                <img src="<?php echo $ptk_s4_right_img_2_url; ?>" alt="d2.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- protek design ends here  -->

<?php

    $result = ob_get_clean();

    return $result;
}
