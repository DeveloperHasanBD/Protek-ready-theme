<?php

add_action('vc_before_init', 'chiamo_third_function');
function chiamo_third_function()
{
    vc_map(
        array(
            "name" => __("Storia", "red-apple"), // Element name
            "base" => "chiamo_third_banner_items", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for home about',
            "class" => "chiamo_third-banner",
            "category" => __('Chi Siamo', 'red-apple'),
            'params' => array( 

                array(
                    "type" => "textarea",
                    "holder" => "",
                    "class" => "",
                    "heading" => __("Top Title", "red-apple"),
                    "param_name" => "chiamo_third_section_title",
                    "value" => __("", "red-apple"),
                ), 

                array(

                    'type' => 'param_group',
                    'param_name' => 'chiamo_third_repeater',
                    'params' => array(
                        
                        array(
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Counter Number", "red-apple"),
                            "param_name" => "chiamo_third_title",
                            "value" => __("", "red-apple"),
                        ),

                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Counter Subtitle", "red-apple"),
                            "param_name" => "chiamo_third_subtitle",
                            "value" => __("", "red-apple"),
                        ),

                        array(
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Counter Description", "red-apple"),
                            "param_name" => "chiamo_third_desc",
                            "value" => __("", "red-apple"),
                        ),

                    )

                ),


            )
        )
    );
}


add_shortcode('chiamo_third_banner_items', 'chiamo_third_banner_code');

function chiamo_third_banner_code($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'chiamo_third_repeater' => '',
        'chiamo_third_section_title' => '',

    ), $atts, 'chiamo_third_banner_items');

    $chiamo_third_section_title = $atts['chiamo_third_section_title'] ?? '';    
    $chiamo_third_repeater = vc_param_group_parse_atts($atts['chiamo_third_repeater']);

?> 

      <!-- chisiamo counter start from here  -->
      <section class="chisiamo-counter-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="counter-title">
                        <h3> <?php echo $chiamo_third_section_title; ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">

                  <?php
                        foreach ($chiamo_third_repeater as $chiamo_third) {
                            $chiamo_third_title = $chiamo_third['chiamo_third_title'];
                            if(!empty($chiamo_third['chiamo_third_subtitle'])){
                                $chiamo_third_subtitle = $chiamo_third['chiamo_third_subtitle'];
                            }
                        $chiamo_third_desc = $chiamo_third['chiamo_third_desc'];  
                   ?>       
                       
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="single-coutnerup">
                            <span class="count-num"><?php echo $chiamo_third_title; ?></span>
                            <?php if(!empty($chiamo_third['chiamo_third_subtitle'])){?>
                            <span class="counter-text"><?php echo $chiamo_third['chiamo_third_subtitle'] ; ?></span>
                            <?php } ?>
                            <h4 class="title"> <?php echo $chiamo_third_desc; ?> </h4>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
    <!-- chisiamo counter end here  -->

<?php
    $result = ob_get_clean();
    return $result;
}
