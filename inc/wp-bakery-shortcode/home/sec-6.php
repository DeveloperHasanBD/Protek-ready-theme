<?php
add_action('vc_before_init', 'redp_home_sec_6_backend');
function redp_home_sec_6_backend()
{

    vc_map(
        array(
            "name"          => __("Ambiente", "redapple"), // Element name
            "base"          => "redp_home_sec_6", // Element shortcode
            'icon'          => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description'   => 'Dedicated for redapple',
            "class"         => "redapple-cstm",
            "category"      => __('Home', 'redapple'),
            "params" => array(
                array(
                    "type"          => "textfield",
                    "heading"       => "Title",
                    "param_name"    => "hm_s6_title",
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => "Title",
                    "param_name"    => "hm_s6_desc",
                ),
                array(
                    "type"          => "vc_link",
                    "heading"       => "URL",
                    "param_name"    => "hm_s6_url",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => "Right image",
                    "param_name"    => "hm_s6_right_img",
                ),
            ),
        )
    );
}


add_shortcode('redp_home_sec_6', 'redp_home_sec_6_view');

function redp_home_sec_6_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'hm_s6_title'               => '',
        'hm_s6_desc'                => '',
        'hm_s6_url'                 => '',
        'hm_s6_right_img'           => '',
    ), $atts, 'redp_home_sec_6');

    $hm_s6_title           = $atts['hm_s6_title'] ?? '';
    $hm_s6_desc            = $atts['hm_s6_desc'] ?? '';

    $hm_s6_right_img_id    = $atts['hm_s6_right_img'] ?? '';
    $hm_s6_right_img_url   = wp_get_attachment_image_url($hm_s6_right_img_id, 'full');

    $hm_s6_url_dtls        = vc_build_link($atts['hm_s6_url']) ?? '';
    $hm_s6_url             = $hm_s6_url_dtls['url'] ?? '';
    $hm_s6_url_title       = $hm_s6_url_dtls['title'] ?? '';
?>

    <!-- home about protek starts from here  -->
    <section class="home-portek-main home-sostenibilità-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="home-common-title">
                        <h2><?php echo $hm_s6_title; ?></h2>
                    </div>
                    <div class="about-protek">
                        <p><?php echo $hm_s6_desc; ?></p>
                        <div class="scorpi-btn">
                            <a href="<?php echo $hm_s6_url; ?>">
                                <?php
                                if ($hm_s6_url_title) {
                                    echo $hm_s6_url_title;
                                } else {
                                    echo 'scopri di più';
                                }
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                    <path d="M64.3536 4.35355C64.5488 4.15829 64.5488 3.8417 64.3536 3.64644L61.1716 0.464461C60.9763 0.269199 60.6597 0.269199 60.4645 0.464461C60.2692 0.659723 60.2692 0.976305 60.4645 1.17157L63.2929 3.99999L60.4645 6.82842C60.2692 7.02368 60.2692 7.34027 60.4645 7.53553C60.6597 7.73079 60.9763 7.73079 61.1716 7.53553L64.3536 4.35355ZM4.37114e-08 4.5L64 4.49999L64 3.49999L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 d-none d-md-block d-lg-block"></div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 px-0">
                    <div class="protek-images">
                        <img src="<?php echo $hm_s6_right_img_url; ?>" alt="protek.png">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- home about protek ends here  -->

<?php

    $result = ob_get_clean();

    return $result;
}
