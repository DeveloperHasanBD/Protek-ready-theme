<?php
add_action('vc_before_init', 'redp_contact_sec_1_backend');
function redp_contact_sec_1_backend()
{
    vc_map(
        array(
            "name" => __("Contact info", "redapple"), // Element name
            "base" => "redp_contact_sec_1", // Element shortcode
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for redapple',
            "class" => "redapple-cstm",
            "category" => __('Contact', 'redapple'),
            'params' => array(
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_title",
                    "heading"       => __("Content", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textarea",
                    "param_name"    => "cnt_address",
                    "heading"       => __("Content", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_phone",
                    "heading"       => __("Phone", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_fax",
                    "heading"       => __("Fax", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_email",
                    "heading"       => __("Email", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textfield",
                    "param_name"    => "cnt_piva",
                    "heading"       => __("P.IVA", "redapple"),
                    "value"         => "",
                ),
                array(
                    "type"          => "textarea",
                    "param_name"    => "cnt_map",
                    "heading"       => __("Content", "redapple"),
                    "value"         => "",
                ),
            )
        )
    );
}


add_shortcode('redp_contact_sec_1', 'redp_contact_sec_1_view');

function redp_contact_sec_1_view($atts)

{

    ob_start();
    $atts = shortcode_atts(array(

        'cnt_title'     => '',
        'cnt_address'   => '',
        'cnt_phone'     => '',
        'cnt_fax'       => '',
        'cnt_email'     => '',
        'cnt_piva'      => '',
        'cnt_map'       => '',

    ), $atts, 'redp_contact_sec_1');



    $cnt_title      = $atts['cnt_title'] ?? '';
    $cnt_address    = $atts['cnt_address'] ?? '';
    $cnt_phone      = $atts['cnt_phone'] ?? '';
    $cnt_fax        = $atts['cnt_fax'] ?? '';
    $cnt_email      = $atts['cnt_email'] ?? '';
    $cnt_piva       = $atts['cnt_piva'] ?? '';
    $cnt_map        = $atts['cnt_map'] ?? '';


?>
    <!-- contatti address start from here  -->
    <section class="contatti-address-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="titlebox">
                        <h2><?php echo $cnt_title; ?></h2>
                    </div>
                    <div class="addressbook">
                        <div class="icon">
                            <i class="fa-thin fa-location-dot"></i>
                        </div>
                        <div class="single-addresslink">
                            <ul>
                                <li>
                                    <a class="address_not_click" href="#" target="_blank">
                                        <?php echo $cnt_address; ?>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <div class="single-addresslink">
                            <ul>
                                <li><a href="tel:<?php echo $cnt_phone; ?>">tel. <?php echo $cnt_phone; ?></a></li>
                                <li><a href="fax:<?php echo $cnt_fax; ?>">fax. <?php echo $cnt_fax; ?></a></li>
                            </ul>
                        </div>
                        <div class="single-addresslink">
                            <ul>
                                <li>
                                    <a href="mailto:<?php echo $cnt_email; ?>"><?php echo $cnt_email; ?></a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $cnt_piva; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="map-iframe">
                        <iframe src="<?php echo $cnt_map; ?>" width="" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contatti address end here  -->


<?php

    $result = ob_get_clean();

    return $result;
}
