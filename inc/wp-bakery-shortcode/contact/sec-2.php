<?php
add_action('vc_before_init', 'redp_contact_sec_2_backend');
function redp_contact_sec_2_backend()
{
    vc_map(
        array(
            "name" => __("Contact title", "redapple"), // Element name
            "base" => "redp_contact_sec_2", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for redapple',
            "class" => "redapple-cstm",
            "category" => __('Contact', 'redapple'),
            'params' => array(
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_2_title",
                    "heading"       => __("Title", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_2_address",
                    "heading"       => __("Subtitle", "redapple"),
                    "value"         => "",
                ),
            )
        )
    );
}


add_shortcode('redp_contact_sec_2', 'redp_contact_sec_2_view');

function redp_contact_sec_2_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(

        'cnt_2_title'     => '',
        'cnt_2_address'   => '',

    ), $atts, 'redp_contact_sec_2');



    $cnt_2_title      = $atts['cnt_2_title'] ?? '';
    $cnt_2_address    = $atts['cnt_2_address'] ?? '';

?>
    <!-- contatti banner start from here  -->
    <section class="contatti-banner-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2><?php echo $cnt_2_title; ?></h2>
                    <p><?php echo $cnt_2_address; ?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- contatti banner end here  -->

<?php

    $result = ob_get_clean();

    return $result;
}
