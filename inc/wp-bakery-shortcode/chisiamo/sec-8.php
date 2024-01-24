<?php

add_action('vc_before_init', 'chiamo_eighth_function');

function chiamo_eighth_function()
{
    vc_map(
        array(
            "name" => __("Le nostre certificazioni", "red-apple"), // Element name
            "base" => "chiamo_eighth_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for Chiamo page',
            "class" => "chiamo_eighth-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(


                array(

                    'type' => 'param_group',
                    'param_name' => 'chiamo_eighth_repeater',
                    'params' => array(

                        array(
                            "type" => "attach_image",
                            "holder" => "",
                            "class" => "",
                            "heading" => __("Left Image", "red-apple"),
                            "param_name" => "chiamo_eighth_repeater_img",
                            "value" => __("", "red-apple"),
                        ),

                    )

                ),




                array(
                    "type" => "textfield",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Right Title", "red-apple"),
                    "param_name" => "chiamo_eighth_title",
                    "value" => __("", "red-apple"),
                ),

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Right Description", "red-apple"),
                    "param_name" => "chiamo_eighth_desc",
                    "value" => __("", "red-apple"),
                ),

                array(
                    "type"          => "vc_link",
                    "heading"       => "URL",
                    "param_name"    => "sec_8_csm_url",
                ),

            )
        )
    );
}


add_shortcode('chiamo_eighth_banner_items', 'chiamo_eighth_banner_code');

function chiamo_eighth_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_eighth_repeater' => '',
        'chiamo_eighth_title' => '',
        'chiamo_eighth_desc' => '',
        'sec_8_csm_url' => '',
    ), $atts, 'chiamo_eighth_banner_items');

    $chiamo_eighth_title        = $atts['chiamo_eighth_title'] ?? '';
    $chiamo_eighth_desc         = $atts['chiamo_eighth_desc'] ?? '';
    $sec_8_csm_dtls             = vc_build_link($atts['sec_8_csm_url']) ?? '';
    $sec_8_csm_url              = $sec_8_csm_dtls['url'] ?? '';
    $sec_8_csm_url_title        = $ptk_s2_url_dtls['title'] ?? '';
    $chiamo_eighth_repeater     = vc_param_group_parse_atts($atts['chiamo_eighth_repeater']);

?>


    <!-- chisiamo certifacte section start from here  -->
    <section class="chisiamo-certifacate-main">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="certifica-iamgebox">
                        <div class="certifica-grid">


                            <?php
                            foreach ($chiamo_eighth_repeater as $chiamo_eighth) {
                                $chiamo_eighth_repeater_img = $chiamo_eighth['chiamo_eighth_repeater_img'] ?? '';
                                $chiamo_eighth_repeater_img_url = wp_get_attachment_image_url($chiamo_eighth_repeater_img, 'full');
                            ?>
                                <div class="single-grid">
                                    <img src="<?php echo $chiamo_eighth_repeater_img_url; ?>" alt="">
                                </div>
                            <?php } ?>



                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="certificate-title">
                        <h3><?php echo  $chiamo_eighth_title; ?></h3>
                    </div>
                    <div class="certificate-desc">
                        <?php echo  $chiamo_eighth_desc; ?>
                        <div class="certifca-btn">
                            <a href="<?php echo  $sec_8_csm_url; ?>">
                                <?php
                                if ($sec_8_csm_url_title) {
                                    echo  $sec_8_csm_url_title;
                                } else {
                                    echo 'vedi tutte le certificazioni';
                                }
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="8" viewBox="0 0 65 8" fill="none">
                                    <path d="M64.5213 4.35355C64.7166 4.15829 64.7166 3.8417 64.5213 3.64644L61.3394 0.464461C61.1441 0.269199 60.8275 0.269199 60.6322 0.464461C60.437 0.659723 60.437 0.976305 60.6322 1.17157L63.4607 3.99999L60.6322 6.82842C60.437 7.02368 60.437 7.34027 60.6322 7.53553C60.8275 7.73079 61.1441 7.73079 61.3394 7.53553L64.5213 4.35355ZM0.234375 4.5L64.1678 4.49999L64.1678 3.49999L0.234375 3.5L0.234375 4.5Z" fill="black" />
                                </svg>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- chisiamo certifacte section ends here  -->


<?php
    $result = ob_get_clean();
    return $result;
}
