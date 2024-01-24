<?php

add_action('vc_before_init', 'chiamo_second_function');

function chiamo_second_function()
{
    vc_map(
        array(
            "name" => __("Il mondo cambia", "red-apple"), // Element name
            "base" => "chiamo_second_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for Chiamo page',
            "class" => "chiamo_second-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Top Title", "red-apple"),
                    "param_name" => "chiamo_second_title",
                    "value" => __("", "red-apple"),
                ), 

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Description", "red-apple"),
                    "param_name" => "chiamo_second_desc",
                    "value" => __("", "red-apple"),
                ), 

            )
        )
    );
}


add_shortcode('chiamo_second_banner_items', 'chiamo_second_banner_code');

function chiamo_second_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_second_title' => '',
        'chiamo_second_desc' => '',              
    ), $atts, 'chiamo_second_banner_items');

    $chiamo_second_title = $atts['chiamo_second_title'] ?? '';  
    $chiamo_second_desc = $atts['chiamo_second_desc'] ?? '';   


?> 
        <!-- about section start from here  -->
        <section class="chisiamo-description-main">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo $chiamo_second_title; ?></h3>

                            <p><?php echo $chiamo_second_desc; ?></p>
                        </div>
                    </div>
                </div>
        </section>
        <!-- about section ends here  -->

<?php
    $result = ob_get_clean();
    return $result;
}
