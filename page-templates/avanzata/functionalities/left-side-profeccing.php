<?php



/**

 * Total processed functionalities

 * 1. collezione

 * 2. IN /OUT

 * 3. tipo-di-parete

 * 4. tipo-di-apertura

 * 5. colore

 * 6. misure

 */



/**

 * start collezione

 */

$collezione_terms = get_terms(

    array(

        'taxonomy' => 'collezione',

        'parent' => 44,

        'hide_empty' => false

    ),

);

$total_collection = count($collezione_terms);



$c_parent_list    = [];

$c_child_list     = [];


$is_product_c_parent_terms = 0;
$is_product_c_child_terms = 0;
if ($total_collection > 0) {

    $i = 0;

    $j = 0;

    foreach ($collezione_terms as $parent_collection) {

        $parent_term_id = $parent_collection->term_id ?? '';

        $parent_term_name = $parent_collection->name ?? '';
        $parent_term_count = $parent_collection->count ?? 0;
        if($parent_term_count > 0){
            $is_product_c_parent_terms++;
        }
        $get_child_terms = get_terms(

            array(

                'taxonomy'      => 'collezione',

                'parent'        => $parent_term_id,

                'hide_empty'    => false

            ),

        );



        $c_parent_list[$i]['c_parent_id']   = $parent_term_id;
        $c_parent_list[$i]['c_parent_name'] = $parent_term_name;
        $c_parent_list[$i]['count']         = $parent_term_count;

        $i++;

        foreach ($get_child_terms as $single_child_term) {

            $child_term_id      = $single_child_term->term_id ?? '';

            $child_term_name    = $single_child_term->name ?? '';
            $child_term_count    = $single_child_term->count ?? 0;
            if($child_term_count > 0){
                $is_product_c_child_terms++;
            }


            $c_child_list[$j]['c_child_id']     = $child_term_id;
            $c_child_list[$j]['c_child_name']   = $child_term_name;
            $c_child_list[$j]['count']          = $child_term_count;

            $j++;



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

        }

    }

}



/**

 * end collezione_terms

 */





/**

 * Start in-out

 */

$in_out_terms = get_terms(

    array(

        'taxonomy' => 'in-out',

        'parent' => 0,

        'hide_empty' => false

    ),

);
$is_products_in_out_terms = 0;
foreach($in_out_terms as $in_out_term){
    if($in_out_term->count > 0){
        $is_products_in_out_terms++;
    }
}


$total_in_out = count($in_out_terms);



/**

 * End in-out

 */





/**

 * Start tipo-di-parete

 */

$di_parete_terms = get_terms(

    array(

        'taxonomy' => 'tipo-di-parete',

        'parent' => 0,

        'hide_empty' => false

    ),

);

$is_products_di_parete_terms = 0;
foreach($di_parete_terms as $di_parete_term){
    if($di_parete_term->count > 0){
        $is_products_di_parete_terms++;
    }
}

$total_di_parete = count($di_parete_terms);



/**

 * End tipo-di-parete

 */



/**

 * Start tipo-di-apertura

 */

$di_apertura_terms = get_terms(

    array(

        'taxonomy' => 'tipo-di-apertura',

        'parent' => 0,

        'hide_empty' => false

    ),

);

$is_products_di_apertura_terms = 0;
foreach($di_apertura_terms as $di_apertura_term){
    if($di_apertura_term->count > 0){
        $is_products_di_apertura_terms++;
    }
}

$total_di_apertura = count($di_apertura_terms);



/**

 * End tipo-di-parete

 */



/**

 * Start colore

 */

$colore_terms = get_terms(

    array(

        'taxonomy' => 'colore',

        'parent' => 0,

        'hide_empty' => false

    ),

);

$is_products_colore_terms = 0;
foreach($colore_terms as $colore_term){
    if($colore_term->count > 0){
        $is_products_colore_terms++;
    }
}

$total_colore = count($colore_terms);



/**

 * End colore

 */



/**

 * Start special_terms

 */

$special_terms = get_terms(

    array(

        'taxonomy' => 'special-category',

        'parent' => 0,

        'hide_empty' => false

    ),

);
$is_products_special_term = 0;
foreach($special_terms as $special_term){
    if($special_term->count > 0){
        $is_products_special_term++;
    }
}

$total_special = count($special_terms);



/**

 * End special_terms

 */



/**

 * Start misure

 */



$misure_terms = get_terms(

    array(

        'taxonomy' => 'misure',

        'parent' => 0,

        'hide_empty' => false

    ),

);



$total_misure = count($misure_terms);


$is_products_misure_terms = 0;
$misure_term_id_name = [];

if ($total_misure <= 2) {

    $mi = 0;

    foreach ($misure_terms as $single_misure_terms) {

        $misure_term_id     = $single_misure_terms->term_id;

        $misure_term_name   = $single_misure_terms->name;
        
        if($single_misure_terms->count > 0){
            $is_products_misure_terms++;
        }


        $misure_term_id_name[$mi]['misure_terms_id']    = $misure_term_id;

        $misure_term_id_name[$mi]['misure_terms_name']  = $misure_term_name;

        $mi++;

    }
    $total_misure_name = count($misure_term_id_name);

}





// 0 for "Ingombro"

$misure_terms_id_0   = get_field('ing_ingombro_term_id', 'option');

$misure_terms_name_0 = get_field('ing_ingombro_title', 'option');



// 1 for "LUCE DI PASSAGGIO"

$misure_terms_id_1   =  get_field('lc_passaggio_term_id', 'option');

$misure_terms_name_1 =  get_field('lc_di_passaggio_title', 'option');



$mis_args_1 = array(

    'post_type' => 'prodotti',

    'fields'        => 'ids',

    'tax_query' => array(

        array(

            'taxonomy' => 'misure',

            'field' => 'term_id',

            'terms' => $misure_terms_id_1,

        ),

    ),

);

$mis_query_1 = new WP_Query($mis_args_1);



$pass_min_val   = [];

$pass_max_val   = [];

$largh_min_val  = [];

$largh_max_val  = [];



if ($mis_query_1->have_posts()) {

    $total_mis_1_posts = $mis_query_1->posts;

    foreach ($total_mis_1_posts as $single_mis_1_post_id) {

        $pass_min_val[]   = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_altezza', true);

        $pass_max_val[]   = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_altezza_max', true);

        $largh_min_val[]  = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_larghezza', true);

        $largh_max_val[]  = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_larghezza_max', true);

    }

}

$final_pass_min     = min($pass_min_val);

$final_pass_max     = max($pass_max_val);

$final_largh_min    = min($largh_min_val);

$final_largh_max    = max($largh_max_val);



// ---------- end one ---------------------

// 0 for "Ingombro"

$mis_args_0 = array(

    'post_type' => 'prodotti',

    'fields'        => 'ids',

    'tax_query' => array(

        array(

            'taxonomy' => 'misure',

            'field' => 'term_id',

            'terms' => $misure_terms_id_0,

        ),

    ),

);

$mis_query_0 = new WP_Query($mis_args_0);



$ing_alt_min_val   = [];

$ing_alt_max_val   = [];

$ing_larg_min_val  = [];

$ing_larg_max_val  = [];



if ($mis_query_0->have_posts()) {

    $total_mis_0_posts = $mis_query_0->posts;

    foreach ($total_mis_0_posts as $single_mis_0_post_id) {

        $ing_alt_min_val[]   += get_post_meta($single_mis_0_post_id, 'ingombro_altezza', true);

        $ing_alt_max_val[]   += get_post_meta($single_mis_0_post_id, 'ingombro_altezza_max', true);

        $ing_larg_min_val[]  += get_post_meta($single_mis_0_post_id, 'ingombro_larghezza', true);

        $ing_larg_max_val[]  += get_post_meta($single_mis_0_post_id, 'ingombro_larghezza_max', true);

    }

}



$final_ing_alt_min     = min($ing_alt_min_val);

$final_ing_alt_max     = max($ing_alt_max_val);

$final_ing_larg_min    = min($ing_larg_min_val);

$final_ing_larg_max    = max($ing_larg_max_val);

// ---------- end two ---------------------

/**

 * End misure

 */

