<?php

add_action('vc_before_init', 'chiamo_sixth_function');
function chiamo_sixth_function()
{
    vc_map(
        array(
            "name" => __("Sostenibilità", "red-apple"), // Element name
            "base" => "chiamo_sixth_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for Chiamo page',
            "class" => "chiamo_sixth-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(

                array(
                    "type" => "textfield",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Top Title", "red-apple"),
                    "param_name" => "chiamo_sixth_title",
                    "value" => __("", "red-apple"),
                ),

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Description", "red-apple"),
                    "param_name" => "chiamo_sixth_desc",
                    "value" => __("", "red-apple"),
                ),

                array(
                    "type" => "attach_image",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Right Image", "red-apple"),
                    "param_name" => "chiamo_sixth_img",
                    "value" => __("", "red-apple"),
                ),


            )
        )
    );
}


add_shortcode('chiamo_sixth_banner_items', 'chiamo_sixth_banner_code');

function chiamo_sixth_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_sixth_img' => '',
        'chiamo_sixth_title' => '',
        'chiamo_sixth_desc' => '',
    ), $atts, 'chiamo_sixth_banner_items');

    $chiamo_sixth_title     = $atts['chiamo_sixth_title'] ?? '';
    $chiamo_sixth_desc      = $atts['chiamo_sixth_desc'] ?? '';
    $chiamo_sixth_img       = $atts['chiamo_sixth_img'] ?? '';
    $chiamo_sixth_img_url   = wp_get_attachment_image_url($chiamo_sixth_img, 'full');

?>

    <!-- chisiamo-sostenibilità starts from here  -->
    <section class="home-portek-main chisiamo-sostenibilità-main">
        <div class="container">
            <div class="row">
                <di v class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="home-common-title">
                        <h2> <?php echo $chiamo_sixth_title; ?> </h2>
                    </div>
                    <div class="about-protek">
                        <p><?php echo $chiamo_sixth_desc; ?></p>
                    </div>
                </di>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 d-none d-md-block d-lg-block"></div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="protek-images">
                        <img src="<?php echo $chiamo_sixth_img_url; ?>" alt="sost.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- chisiamo-sostenibilità ends here  -->






<?php
    $result = ob_get_clean();
    return $result;
}
