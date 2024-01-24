<?php



add_action('vc_before_init', 'redp_chismo_sec_1_backend');


function redp_chismo_sec_1_backend()

{

    vc_map(

        array(

            "name" => __("Main slider", "redapple"),
            "base" => "redp_chismo_sec_1",
            'icon' => get_template_directory_uri() . '/assets/images/logo-dark.png',
            'description' => 'Dedicated for redapple',
            "class" => "redapple-cstm",
            "category" => __('Chi Siamo', 'redapple'),
            'params' => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title ", "redapple"),
                    "param_name" => "chsm_2_title",
                    "value" => __("", "redapple"),
                ),
            )
        )
    );
}

add_shortcode('redp_chismo_sec_1', 'redp_chismo_sec_1_view');

function redp_chismo_sec_1_view($atts)

{

    ob_start();

    $atts = shortcode_atts(array(
        'chsm_2_title' => '',
        // 'chsm_2_logos' => '',
    ), $atts, 'redp_chismo_sec_1');

    $chsm_2_title = $atts['chsm_2_title'] ?? '';
    // $chsm_2_logo_ids = $atts['chsm_2_logos'] ?? '';
    // $chsm_2_logo_ids_url = wp_get_attachment_image_url($chsm_2_logo_ids);
    // $items = vc_param_group_parse_atts($atts['octgn_hm_sec_1_sliders_items']);
    // $all_logo_ids = explode(",", $chsm_2_logo_ids);
    // $logo_id_count = count($all_logo_ids);

?>

    <!-- home slider start from here  -->
    <section class="home-slider-main">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-bg" style="background: url(<?php echo get_template_directory_uri();?>/assets/images/chisiamo/chisiamo.png);"> </div>
                    <div class="slider-cotentbox">
                        <h2>pensare oltre </h2>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="slide-bg" style="background: url(<?php echo get_template_directory_uri();?>/assets/images/home/slider1.png);"> </div>
                    <div class="slider-cotentbox">
                        <h2>CONTROTELAI E SISTEMI <br>
                            PER PORTE E FINESTRE SCORREVOLI
                        </h2>
                    </div>

                </div>
                <div class="swiper-slide video-slide" data-swiper-autoplay="">
                    <div class="video-bg">
                        <video autoplay muted loop class="swiper-video">
                            <source src="<?php echo get_template_directory_uri();?>/assets/images/home/video.mp4" type="video/mp4">
                        </video>
                        <div class="slider-cotentbox">
                            <h2>CONTROTELAI E SISTEMI <br>
                                PER PORTE E FINESTRE SCORREVOLI
                            </h2>
                        </div>
                    </div>

                </div>

            </div>

            <!-- <div class="swiper-pagination"></div> -->

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>


        </div>
    </section>
    <!-- home slider ends here  -->

<?php

    $result = ob_get_clean();
    return $result;
}
