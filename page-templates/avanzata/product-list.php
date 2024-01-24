<?php

if (function_exists('get_field')) {



    $collezione_terms = get_terms(
        array(
            'taxonomy'      => 'collezione',
            'parent'        => 44,
            'hide_empty'    => false
        ),
    );

    $total_collection = count($collezione_terms);

    if ($total_collection > 0) {

        foreach ($collezione_terms as $parent_collection) {

            $parent_term_id = $parent_collection->term_id ?? '';

            $parent_term_name = $parent_collection->name ?? '';

            $get_child_terms = get_terms(

                array(

                    'taxonomy'      => 'collezione',

                    'parent'        => $parent_term_id,

                    'hide_empty'    => false

                ),

            );



            foreach ($get_child_terms as $single_child_term) {

                $child_term_id      = $single_child_term->term_id ?? '';

                $child_term_name    = $single_child_term->name ?? '';



                $collec_args = array(

                    'post_type' => 'prodotti',

                    'tax_query' => array(

                        array(

                            'taxonomy'  => 'collezione',

                            'field'     => 'term_id',

                            'terms'     => $child_term_id,

                        ),

                    ),

                );

                $collec_query = new WP_Query($collec_args);



?>

                <div class="collection-types-main">

                    <h4> <strong><?php echo $parent_term_name; ?> </strong>- <?php echo $child_term_name; ?> </h4>

                    <div class="collections-grid-main">



                        <?php

                        if ($collec_query->have_posts()) {

                            while ($collec_query->have_posts()) {

                                $collec_query->the_post();

                        ?>

                                <div class="single-collection">

                                    <a href="<?php the_permalink(); ?>"></a>

                                    <div class="image-box">

                                        <?php

                                        if (has_post_thumbnail()) {

                                        ?>

                                            <img src="<?php echo the_post_thumbnail_url(); ?>" alt="">

                                        <?php

                                        } else {

                                        ?>

                                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/12/default.png" alt="">

                                        <?php

                                        }

                                        ?>



                                        <div class="content-box">



                                            <div class="content">

                                                <p><?php echo get_field('pkt_short_description'); ?></p>

                                                <h5>

                                                    <a href=""><?php the_title(); ?></a>

                                                </h5>

                                            </div>



                                        </div>

                                    </div>

                                </div>

                        <?php

                            }

                            wp_reset_query();

                        }

                        ?>





                    </div>

                </div>

<?php

            }

        }

    }

}

?>