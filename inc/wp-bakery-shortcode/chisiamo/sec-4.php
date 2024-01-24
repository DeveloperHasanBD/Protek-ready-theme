<?php

add_action('vc_before_init', 'chiamo_fourth_function');

function chiamo_fourth_function()
{
    vc_map(
        array(
            "name" => __("Noi", "red-apple"), // Element name
            "base" => "chiamo_fourth_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for Chiamo page',
            "class" => "chiamo_fourth-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(



                array(
                    "type" => "attach_image",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Left Image", "red-apple"),
                    "param_name" => "chiamo_fourth_img",
                    "value" => __("", "red-apple"),
                ),


                array(
                    "type" => "textfield",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Top Title", "red-apple"),
                    "param_name" => "chiamo_fourth_title",
                    "value" => __("", "red-apple"),
                ),

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Description", "red-apple"),
                    "param_name" => "chiamo_fourth_desc",
                    "value" => __("", "red-apple"),
                ),

            )
        )
    );
}


add_shortcode('chiamo_fourth_banner_items', 'chiamo_fourth_banner_code');

function chiamo_fourth_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_fourth_img' => '',
        'chiamo_fourth_title' => '',
        'chiamo_fourth_desc' => '',
    ), $atts, 'chiamo_fourth_banner_items');

    $chiamo_fourth_title    = $atts['chiamo_fourth_title'] ?? '';
    $chiamo_fourth_desc     = $atts['chiamo_fourth_desc'] ?? '';

    $chiamo_fourth_img      = $atts['chiamo_fourth_img'] ?? '';
    $chiamo_fourth_img_url  = wp_get_attachment_image_url($chiamo_fourth_img, 'full');

?>


    <!-- chisiamo noi section start from here  -->
    <section class="chisiamo-noi-main">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="noi-imagebox">
                        <img src="<?php echo $chiamo_fourth_img_url; ?>" alt="noi.png">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="noi-contentbox">
                        <div class="noi-titlebox">
                            <h3> <?php echo $chiamo_fourth_title;  ?> </h3>
                        </div>
                        <div class="description">
                            <?php echo $chiamo_fourth_desc;  ?>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </section>
    <!-- chisiamo noi section ends here  -->



<?php
    $result = ob_get_clean();
    return $result;
}
