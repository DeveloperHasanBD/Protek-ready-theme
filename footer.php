<!-- <button id="scrollToTopBtn"><i class="fa-light fa-arrow-up"></i></button> -->
<?php
$footer_logo            = get_field('ptk_footer_logo', 'option');
$footer_title           = get_field('ptk_footer_title', 'option');
$footer_address         = get_field('ptk_footer_address', 'option');
$footer_tel             = get_field('ptk_footer_tel', 'option');
$footer_tax             = get_field('ptk_footer_fax', 'option');
$footer_email           = get_field('ptk_footer_email', 'option');
$footer_mobile          = get_field('ptk_footer_mobile', 'option');
$footer_top_links       = get_field('ptk_footer_links', 'option');
$footer_bottom_links    = get_field('ptk_footer_bottom_links', 'option');
$social_title           = get_field('ptk_footer_social_title', 'option');
$youtube_url         = get_field('ptk_footer_youtube_url', 'option');
$facebook_url        = get_field('ptk_footer_facebook_url', 'option');
$printerest_url      = get_field('ptk_footer_printerest_url', 'option');
?>
<div class="fixed_contact fixed_contact_url">
    <button id="FloatingContact">
        <a href="<?php echo site_url(); ?>/contatti/"></a>
        <i class="fa-thin fa-messages"></i>
        contattaci </button>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="footer-logo">
                    <a href="#">
                        <img src="<?php echo $footer_logo ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="single-flex-box">
                    <div class="footer-title"> <?php echo $footer_title ?></div>
                    <div class="footer-links">
                        <ul>
                            <li>
                                <a href="#" target="_blank">
                                    <?php echo $footer_address ?>
                                </a>
                            </li>

                        </ul>
                        <ul>

                            <li>
                                <a href="tel:<?php echo $footer_tel ?>">TEL. <?php echo $footer_tel ?></a>
                            </li>
                            <li>
                                <a href="fax:<?php echo $footer_tax ?>">FAX. <?php echo $footer_tax ?></a>
                            </li>

                        </ul>
                        <ul>

                            <li>
                                <a href="mailto:<?php echo $footer_email ?>"><?php echo $footer_email ?></a>
                            </li>
                            <li>
                                <a href="#"><?php echo $footer_mobile ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="single-flex-box">

                    <div class="footer-links">
                        <?php if ($footer_top_links) { ?>
                            <ul>
                                <?php foreach ($footer_top_links as $footer_top_link) { ?>
                                    <li>
                                        <a href="<?php echo $footer_top_link['url'] ?>"><?php echo $footer_top_link['title'] ?></a>
                                    </li>
                                <?php } ?>
                                <!-- <li>
                                <a href="#">LINEAR COLLECTION</a>
                            </li>
                            <li>
                                <a href="#">MAGIC BOX</a>
                            </li>
                            <li>
                                <a href="#">SKUDO</a>
                            </li>
                            <li>
                                <a href="#">WALLOUT</a>
                            </li>
                            <li>
                                <a href="#">OUTDOOR</a>
                            </li>
                            <li>
                                <a href="#">MANIGLIE </a>
                            </li>
                            <li>
                                <a href="#">ACCESSORI</a>
                            </li> -->
                            </ul>
                        <?php } ?>
                        <?php if ($footer_bottom_links) { ?>
                            <ul>
                                <?php foreach ($footer_bottom_links as $footer_bottom_link) { ?>
                                    <li>
                                        <a href="<?php echo $footer_bottom_link['url'] ?>"><?php echo $footer_bottom_link['title'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="footer-social-title"> <?php echo $social_title ?> </div>
                <div class="footer-links-social">
                    <ul>
                            <li>
                                <a href="<?php echo $social_link['url'] ?>"><?php echo $social_link['icon'] ?><?php echo $social_link['title'] ?></a>
                            </li>
                    </ul>
                    <ul>
                        <?php if($youtube_url){?>
                            <li>
                                <a href="<?php echo $youtube_url?>"><i class="fa-brands fa-youtube"></i> youtube</a>
                            </li>
                        <?php }?>
                        <?php if($youtube_url){?>
                            <li>
                                <a href="<?php echo $facebook_url?>"><i class="fa-brands fa-facebook-f"></i> facebook</a>
                            </li>
                        <?php }?>
                        <?php if($youtube_url){?>
                            <li>
                                <a href="<?php echo $printerest_url?>"><i class="fa-brands fa-pinterest-p"></i> printerest</a>
                            </li>
                        <?php }?>
                    </ul>
                    <div class="newsletter">
                        <h5>ISCRIVITI ALLA NEWSLETTER</h5>
                        <form action="">
                            <div class="newsletter-flex">
                                <input type="email" placeholder="inserisci la tua mail">
                                <button type="submit"> iscrititi </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>