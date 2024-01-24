<?php

/**
 * Template name:  PTEK Ricerca avanzata
 */
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/range-slider.css">
<main>
    <!-- breadcrumb section start from here  -->
    <section class="breadcrumb-main">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo home_url()?>/protek-home">PROTEK HOME</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> ricerca avanzata</li>
                        </ol>
                    </div>
                </div>
            </div>

        </nav>
    </section>
    <!-- breadcrumb section ends here  -->
    <!-- avanzata banner start from here  -->
    <section class="avanzata-banner-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2>Ricerca avanzata</h2>
                    <p>cerca il prodotto che meglio soddisfa le tue esigenze </p>
                </div>
            </div>
        </div>
    </section>
    <!-- avanzata banner start from here  -->
    <section class="avanzata-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    <?php include_once("page-templates/avanzata/left-side.php"); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 display_filter_data">
                    <?php include_once("page-templates/avanzata/product-list.php"); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/range-slider.js"></script>
<script>

</script>
<?php
get_footer();
