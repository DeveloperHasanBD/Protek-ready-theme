<?php

add_action('vc_before_init', 'chiamo_seventh_function');
function chiamo_seventh_function()
{
    vc_map(
        array(
            "name" => __("La nostra storia", "red-apple"), // Element name
            "base" => "chiamo_seventh_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for home about',
            "class" => "chiamo_seventh-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array(

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Top Title", "red-apple"),
                    "param_name" => "chiamo_seventh_section_title",
                    "value" => __("", "red-apple"),
                ),

                array(

                    'type' => 'param_group',
                    'param_name' => 'chiamo_seventh_repeater',
                    'params' => array(

                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Counter Title", "red-apple"),
                            "param_name" => "chiamo_seventh_subtitle",
                            "value" => __("", "red-apple"),
                        ),

                        array(
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Counter Description", "red-apple"),
                            "param_name" => "chiamo_seventh_desc",
                            "value" => __("", "red-apple"),
                        ),

                    )

                ),


            )
        )
    );
}


add_shortcode('chiamo_seventh_banner_items', 'chiamo_seventh_banner_code');

function chiamo_seventh_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_seventh_repeater' => '',
        'chiamo_seventh_section_title' => '',

    ), $atts, 'chiamo_seventh_banner_items');

    $chiamo_seventh_section_title = $atts['chiamo_seventh_section_title'] ?? '';
    $chiamo_seventh_repeater = vc_param_group_parse_atts($atts['chiamo_seventh_repeater']);

?>




    <!-- storia section start from here  -->
    <section class="storia-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                    <div class="title-box">
                        <h3><?php echo  $chiamo_seventh_section_title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="swiper year-slider">
                        <div class="swiper-wrapper">



                            <?php
                            foreach ($chiamo_seventh_repeater as $chiamo_seventh) {
                                $chiamo_seventh_title = $chiamo_seventh['chiamo_seventh_subtitle'];
                                $chiamo_seventh_desc =  $chiamo_seventh['chiamo_seventh_desc'] ?? '';

                            ?>



                                <div class="swiper-slide">
                                    <div class="year-contents">
                                        <div class="year"><?php echo $chiamo_seventh_title; ?></div>
                                        <div class="contents">
                                            <?php echo $chiamo_seventh_desc; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>










                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- storia section ends here  -->


<?php
    $result = ob_get_clean();
    return $result;
}
