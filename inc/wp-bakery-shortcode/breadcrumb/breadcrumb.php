<?php
add_action('vc_before_init', 'redp_breadcrumb_sec_1_backend');
function redp_breadcrumb_sec_1_backend()
{
    vc_map(
        array(
            "name" => __("Breadcrumb", "redapple"), // Element name
            "base" => "redp_breadcrumb_sec_1", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for redapple',
            "class" => "redapple-cstm",
            "category" => __('Breadcrumb', 'redapple'),
            'params' => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title ", "redapple"),
                    "param_name" => "octgn_casi_s2_title",
                    "value" => __("", "redapple"),
                ),
            )
        )
    );
}


add_shortcode('redp_breadcrumb_sec_1', 'redp_breadcrumb_sec_1_view');

function redp_breadcrumb_sec_1_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(
        'octgn_casi_s2_title' => '',
    ), $atts, 'redp_breadcrumb_sec_1');

    $octgn_casi_s2_title = $atts['octgn_casi_s2_title'] ?? '';

?>
    <!-- breadcrumb section start from here  -->
    <section class="breadcrumb-main">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ol class="breadcrumb">

                            <?php
                            // if (function_exists('bcn_display')) {
                            //     bcn_display();
                            // }
                            ?>
                           <li class="breadcrumb-item"><a href="<?php echo home_url()?>/protek-home">PROTEK HOME</a></li>

                            <li class="breadcrumb-item active" aria-current="page"> contatti</li> 
                        </ol>
                    </div>
                </div>
            </div>

        </nav>
    </section>
    <!-- breadcrumb section ends here  -->


<?php

    $result = ob_get_clean();

    return $result;
}
