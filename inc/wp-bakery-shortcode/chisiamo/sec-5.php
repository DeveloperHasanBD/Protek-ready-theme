<?php

add_action('vc_before_init', 'chiamo_fifth_function');
function chiamo_fifth_function()
{
    vc_map(
        array(
            "name" => __("I nostri brevetti", "red-apple"), // Element name
            "base" => "chiamo_fifth_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for Chiamo page',
            "class" => "chiamo_fifth-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(

                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section title", "red-apple"),
                    "param_name" => "chiamo_fifth_sec_title",
                    "value" => __("", "red-apple"),
                ),


                array(

                    'type' => 'param_group',
                    'param_name' => 'chiamo_fifth_repeater',
                    'params' => array(

                        array(
                            "type" => "attach_image",
                            "holder" => "",
                            "class" => "",
                            "heading" => __("Image", "red-apple"),
                            "param_name" => "chiamo_fifth_img",
                            "value" => __("", "red-apple"),
                        ),

                        array(
                            "type" => "textarea",
                            "holder" => "",
                            "class" => "",
                            "heading" => __("Description", "red-apple"),
                            "param_name" => "chiamo_fifth_desc",
                            "value" => __("", "red-apple"),
                        ),

                    )

                ),


            )
        )
    );
}


add_shortcode('chiamo_fifth_banner_items', 'chiamo_fifth_banner_code');

function chiamo_fifth_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_fifth_repeater' => '',
        'chiamo_fifth_sec_title' => '',

    ), $atts, 'chiamo_fifth_banner_items');

    $chiamo_fifth_sec_title = $atts['chiamo_fifth_sec_title'] ?? '';
    $chiamo_fifth_repeater = vc_param_group_parse_atts($atts['chiamo_fifth_repeater']);



?>



    <!-- breveti section start from here  -->

    <section class="breveti-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="title-box">
                        <h3>i nostri brevetti</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">

                <?php
                foreach ($chiamo_fifth_repeater as $chiamo_fifth) {
                    $chiamo_fifth_desc      =  $chiamo_fifth['chiamo_fifth_desc'] ?? '';
                    $chiamo_fifth_img       = $chiamo_fifth['chiamo_fifth_img'] ?? '';
                    $chiamo_fifth_img_url   = wp_get_attachment_image_url($chiamo_fifth_img, 'full');
                ?>

                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="single-brevetti">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="brevatti-imagebox">
                                        <img src="<?php echo $chiamo_fifth_img_url; ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="brevetti-desc">
                                        <?php echo $chiamo_fifth_desc; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>







            </div>
        </div>
    </section>

    <!-- breveti section start from here  -->





<?php
    $result = ob_get_clean();
    return $result;
}
