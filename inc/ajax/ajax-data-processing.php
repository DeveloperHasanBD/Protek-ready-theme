<?php



add_action('wp_ajax_product_filter_form_action', 'product_filter_form_action');
add_action('wp_ajax_nopriv_product_filter_form_action', 'product_filter_form_action');
add_action('wp_ajax_get_categories_by_id', 'get_categories_by_id');
add_action('wp_ajax_nopriv_get_categories_by_id', 'get_categories_by_id');
add_action('wp_ajax_get_products_by_sub_cat_id', 'get_products_by_sub_cat_id');
add_action('wp_ajax_nopriv_get_products_by_sub_cat_id', 'get_products_by_sub_cat_id');
add_action('wp_ajax_get_product_by_product_id', 'get_product_by_product_id');
add_action('wp_ajax_nopriv_get_product_by_product_id', 'get_product_by_product_id');
add_action('wp_ajax_get_product_by_product_title', 'get_product_by_product_title');
add_action('wp_ajax_nopriv_get_product_by_product_title', 'get_product_by_product_title');

function get_product_by_product_title(){
    $search = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $args = [
        'post_type'  => 'prodotti',
        'posts_per_page' => -1,
        '_meta_or_title' => $search,   // Our new custom argument!
        'meta_query'    => [
            [
                'key'     => 'pkt_short_description',
                'value'   => $search,
                'compare' => 'like'
            ]
        ],
    ];
    $search_query   = new WP_Query($args);
    $html           = '<div class="container">';
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {             
            $search_query->the_post();
            $post_id            = get_the_ID();
            $post_title         = get_the_title();  
            $short_description  = get_field('pkt_short_description'); 
            $prodotti_download_options = get_field('prodotti_download_options',$post_id);
            if($prodotti_download_options){
                $html .= '<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="area-download-bg">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="areabg-titlebox">
                                                <h4>'.$post_title.'</h4>
                                                <h5>'.$short_description.'</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">';  
                                        foreach($prodotti_download_options as $prodotti_download_option){
                                            $option_title = $prodotti_download_option['title'];
                                            $html .= '
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                    <div class="download-file">
                                                        <h6>'.$option_title.'</h6>';
                                                        foreach($prodotti_download_option['files'] as $prodotti_download_option_file){
                                                            $file_url       = $prodotti_download_option_file['file_item']['url'];
                                                            $file_title     = $prodotti_download_option_file['file_item']['title'];
                                                            $file_subtype   = $prodotti_download_option_file['file_item']['subtype'];
                                                            $file_size      = $prodotti_download_option_file['file_item']['filesize'];
                                                            $html .= '
                                                                    <div class="single-file">
                                                                        <a href="'.$file_url.'" download>
                                                                            <div class="download-flex">
                                                                                <div class="file-name">'.$file_title.'</div>
                                                                                <div class="file-type" style="min-width:100px;">
                                                                                '.$file_subtype.' <span>'.$file_size.' kb</span>
                                                                                </div>
                                                                                <div class="download-icon">
                                                                                    <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>';
                                                        }
                                                    $html .= '</div>
                                                </div>';
                                        }
                        $html .= '  </div>';
                        $html .= '
                                    <div class="row justify-content-between">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 d-none d-lg-block"></div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                            <div class="download-file">
                                                <div class="single-file">
                                                    <a href="#" target="_blank">
                                                        <div class="download-flex">
                                                            <div class="file-name">SCARICA TUTTA LA DOCUMENTAZIONE </div>
                                                            <div class="file-type">
                                                                <span></span>
                                                            </div>
                                                            <div class="download-icon">
                                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            ';
            }
        }
    }else{
        $html .= '<div><p style="text-align: center;color: #C11C28;">No data found!</p></div>';
    }
    $html .= '</div>';
    $response['product']       = $html;
    echo  json_encode($response);
    die;
}
function get_product_by_product_id(){
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $product    = get_post($product_id);
    $categories = wp_get_post_terms($product_id,'collezione');
    $category_name      = '';
    $sub_category_name  = '';
    $sub_categories     = array();
    $sub_cat_parent     = array();

    foreach($categories as $category){
        if($category->parent != 0){
            $sub_categories[]   = $category;
            $sub_cat_parent[]   = $category->parent;
        }
    }
    foreach($sub_categories as $sub_category){
        if(in_array($sub_category->term_id,$sub_cat_parent)){
            $category_name = $sub_category->name;
        }else{
            $sub_category_name = $sub_category->name;
        }
    }

    $html = '';
    $is_product = false;
    $html .= '
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="collection-title">
                            <h5>'.$category_name.' COLLECTION </h5>
                            <h3>'.$sub_category_name.'</h3>
                        </div>
                    </div>
                </div>';
        $post_id            = $product_id;
        $post_title         = $product->post_title;  
        $short_description  = get_field('pkt_short_description',$post_id); 
        $prodotti_download_options = get_field('prodotti_download_options',$post_id);
        if($prodotti_download_options){
            $is_product = true;
            $html .= '<div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="area-download-bg">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="areabg-titlebox">
                                            <h4>'.$post_title.'</h4>
                                            <h5>'.$short_description.'</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">';  
                                    foreach($prodotti_download_options as $prodotti_download_option){
                                        $option_title = $prodotti_download_option['title'];
                                        $html .= '
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                <div class="download-file">
                                                    <h6>'.$option_title.'</h6>';
                                                    foreach($prodotti_download_option['files'] as $prodotti_download_option_file){
                                                        $file_url       = $prodotti_download_option_file['file_item']['url'];
                                                        $file_title     = $prodotti_download_option_file['file_item']['title'];
                                                        $file_subtype   = $prodotti_download_option_file['file_item']['subtype'];
                                                        $file_size      = $prodotti_download_option_file['file_item']['filesize'];
                                                        $html .= '
                                                                <div class="single-file">
                                                                    <a href="'.$file_url.'" download>
                                                                        <div class="download-flex">
                                                                            <div class="file-name">'.$file_title.'</div>
                                                                            <div class="file-type" style="min-width:100px;">
                                                                            '.$file_subtype.' <span>'.$file_size.' kb</span>
                                                                            </div>
                                                                            <div class="download-icon">
                                                                                <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>';
                                                    }
                                                $html .= '</div>
                                            </div>';
                                    }
                    $html .= '  </div>';
                    $html .= '
                                <div class="row justify-content-between">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 d-none d-lg-block"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                        <div class="download-file">
                                            <div class="single-file">
                                                <a href="#" target="_blank">
                                                    <div class="download-flex">
                                                        <div class="file-name">SCARICA TUTTA LA DOCUMENTAZIONE </div>
                                                        <div class="file-type">
                                                            <span></span>
                                                        </div>
                                                        <div class="download-icon">
                                                            <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        ';
        }
    if($is_product == false){
        $html = '<div><p style="text-align: center;color: #C11C28;">No data found!</p></div>';
    }
    $response['product']       = $html;
    echo  json_encode($response);
    die;
}
function get_products_by_sub_cat_id(){
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $html = '<option value=""> prodotto </option>';
    if($category_id){

        $product_arg = array(
            'post_type' => 'prodotti',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'collezione',
                    'field'     => 'term_id',
                    'terms'     => $category_id,
                ),
            ),
        );
        $product_query = new WP_Query($product_arg);
        if ($product_query->have_posts()) { 
            while ($product_query->have_posts()) { 
                $product_query->the_post();
                $post_id        = get_the_ID();
                $post_title     = get_the_title();
                $options        = get_field('prodotti_download_options');
                if($options){
                    $html .= '<option value="'.$post_id.'">'.$post_title.'</option>';
                }
            }
        }
    }
    $product_html = get_area_download_posts($category_id,false);
    $response['html']       = $html;
    $response['product']    = $product_html;
    echo  json_encode($response);
    die;
}
function get_area_download_posts($cat_id,$post_id){

    $category_products  = array();
    $area_category_name = '';
    $area_category_id   = '';

    $product_arg = array(
                        'post_type' => 'prodotti',
                    );
    if($post_id){
        $product_arg['p'] = $post_id;
    }else{
        $product_arg['tax_query'][0] = array(
            'taxonomy'  => 'collezione',
            'field'     => 'term_id',
            'terms'     => $cat_id,
        );
    }
    $product_query = new WP_Query($product_arg);
    $category      = get_term($cat_id);
    $category_name = $category->name;
    $category_id   = $category->term_id;
    $sub_categories = get_terms(
        array(
            'taxonomy'      => 'collezione',
            'parent'        => $category_id,
            'hide_empty'    => false
        ),
    );
    $html = '';
    $is_product = false;
    
    if(count($sub_categories) > 0){
        foreach($sub_categories as $sub_category){
            $sub_cat_product_arg = array(
                'post_type' => 'prodotti',
                'tax_query' => array(
                    array(
                        'taxonomy'  => 'collezione',
                        'field'     => 'term_id',
                        'terms'     => $sub_category->term_id,
                    ),
                ),
            );
            $sub_cat_product_query = new WP_Query($sub_cat_product_arg);
            if ($sub_cat_product_query->have_posts()) {
                $html .= '
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="collection-title">
                                        <h5>'.$category_name.' COLLECTION </h5>
                                        <h3>'.$sub_category->name.'</h3>
                                    </div>
                                </div>
                            </div>';
                while ($sub_cat_product_query->have_posts()) {             
                    $sub_cat_product_query->the_post();
                    $post_id            = get_the_ID();
                    $post_title         = get_the_title();  
                    $short_description  = get_field('pkt_short_description'); 
                    $prodotti_download_options = get_field('prodotti_download_options',$post_id);
                    if($prodotti_download_options){
                        $is_product = true;
                        $html .= '<div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="area-download-bg">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="areabg-titlebox">
                                                        <h4>'.$post_title.'</h4>
                                                        <h5>'.$short_description.'</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between">';  
                                                foreach($prodotti_download_options as $prodotti_download_option){
                                                    $option_title = $prodotti_download_option['title'];
                                                    $html .= '
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                            <div class="download-file">
                                                                <h6>'.$option_title.'</h6>';
                                                                foreach($prodotti_download_option['files'] as $prodotti_download_option_file){
                                                                    $file_url       = $prodotti_download_option_file['file_item']['url'];
                                                                    $file_title     = $prodotti_download_option_file['file_item']['title'];
                                                                    $file_subtype   = $prodotti_download_option_file['file_item']['subtype'];
                                                                    $file_size      = $prodotti_download_option_file['file_item']['filesize'];
                                                                    $html .= '
                                                                            <div class="single-file">
                                                                                <a href="'.$file_url.'" download>
                                                                                    <div class="download-flex">
                                                                                        <div class="file-name">'.$file_title.'</div>
                                                                                        <div class="file-type" style="min-width:100px;">
                                                                                        '.$file_subtype.' <span>'.$file_size.' kb</span>
                                                                                        </div>
                                                                                        <div class="download-icon">
                                                                                            <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>';
                                                                }
                                                            $html .= '</div>
                                                        </div>';
                                                }
                                $html .= '  </div>';
                                $html .= '
                                            <div class="row justify-content-between">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 d-none d-lg-block"></div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                    <div class="download-file">
                                                        <div class="single-file">
                                                            <a href="#" target="_blank">
                                                                <div class="download-flex">
                                                                    <div class="file-name">SCARICA TUTTA LA DOCUMENTAZIONE </div>
                                                                    <div class="file-type">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="download-icon">
                                                                        <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    ';
                    }
                }
            }
        }
    }else{
        $parent_id          = $category->parent;
        $parent_category    = get_term($parent_id);
        $category_name      = $parent_category->name;
        $category_id        = $parent_category->term_id;

        $sub_cat_product_arg = array(
            'post_type' => 'prodotti',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'collezione',
                    'field'     => 'term_id',
                    'terms'     => $cat_id,
                ),
            ),
        );
        $sub_cat_product_query = new WP_Query($sub_cat_product_arg);
        if ($sub_cat_product_query->have_posts()) {
            $html .= '
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="collection-title">
                                    <h5>'.$category_name.' COLLECTION </h5>
                                    <h3>'.$category->name.'</h3>
                                </div>
                            </div>
                        </div>';
            while ($sub_cat_product_query->have_posts()) {             
                $sub_cat_product_query->the_post();
                $post_id            = get_the_ID();
                $post_title         = get_the_title();  
                $short_description  = get_field('pkt_short_description'); 
                $prodotti_download_options = get_field('prodotti_download_options',$post_id);
                if($prodotti_download_options){
                    $is_product = true;
                    $html .= '<div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="area-download-bg">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="areabg-titlebox">
                                                    <h4>'.$post_title.'</h4>
                                                    <h5>'.$short_description.'</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">';  
                                            foreach($prodotti_download_options as $prodotti_download_option){
                                                $option_title = $prodotti_download_option['title'];
                                                $html .= '
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                        <div class="download-file">
                                                            <h6>'.$option_title.'</h6>';
                                                            foreach($prodotti_download_option['files'] as $prodotti_download_option_file){
                                                                $file_url       = $prodotti_download_option_file['file_item']['url'];
                                                                $file_title     = $prodotti_download_option_file['file_item']['title'];
                                                                $file_subtype   = $prodotti_download_option_file['file_item']['subtype'];
                                                                $file_size      = $prodotti_download_option_file['file_item']['filesize'];
                                                                $html .= '
                                                                        <div class="single-file">
                                                                            <a href="'.$file_url.'" download>
                                                                                <div class="download-flex">
                                                                                    <div class="file-name">'.$file_title.'</div>
                                                                                    <div class="file-type" style="min-width:100px;">
                                                                                    '.$file_subtype.' <span>'.$file_size.' kb</span>
                                                                                    </div>
                                                                                    <div class="download-icon">
                                                                                        <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>';
                                                            }
                                                        $html .= '</div>
                                                    </div>';
                                            }
                            $html .= '  </div>';
                            $html .= '
                                        <div class="row justify-content-between">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 d-none d-lg-block"></div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                                <div class="download-file">
                                                    <div class="single-file">
                                                        <a href="#" target="_blank">
                                                            <div class="download-flex">
                                                                <div class="file-name">SCARICA TUTTA LA DOCUMENTAZIONE </div>
                                                                <div class="file-type">
                                                                    <span></span>
                                                                </div>
                                                                <div class="download-icon">
                                                                    <i class="fa-sharp fa-regular fa-arrow-down-to-line"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                ';
                }
            }
        }
    } 
    if($is_product == false){
        $html = '<div><p style="text-align: center;color: #C11C28;">No data found!</p></div>';
    }
    return $html;
}
function get_categories_by_id(){

    $category_id    = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $html           = '<option value=""> cataloghi </option>';

    if($category_id){
        $categories = get_terms(
            array(
                'taxonomy'      => 'collezione',
                'parent'        => $category_id,
                'hide_empty'    => false
            ),
        );
        foreach($categories as $category){
            $html .= '<option value="'.$category->term_id.'">'.$category->name.'</option>';
        }
    }
    $product_html = get_area_download_posts($category_id,false);
    $response['html']       = $html;
    $response['product']    = $product_html;
    echo  json_encode($response);
    die;

}
function get_misure_terms_values_by_posts($product_ids,$post_terms){
    $misure_terms = $post_terms;
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

    $misure_ids    = wp_list_pluck($misure_term_id_name, 'misure_terms_id');
    // 0 for "Ingombro"
    
    $misure_terms_id_0   = get_field('ing_ingombro_term_id', 'option');
    $misure_terms_name_0 = get_field('ing_ingombro_title', 'option');

    // 1 for "LUCE DI PASSAGGIO"
    
    $misure_terms_id_1   =  get_field('lc_passaggio_term_id', 'option');
    $misure_terms_name_1 =  get_field('lc_di_passaggio_title', 'option');
    
    $pass_min_val       = [];
    $pass_max_val       = [];
    $largh_min_val      = [];
    $largh_max_val      = [];
    $final_pass_min     = 0;
    $final_pass_max     = 0;
    $final_largh_min    = 0;
    $final_largh_max    = 0;
    
    
    
    if(in_array($misure_terms_id_1,$misure_ids)){
        $mis_args_1 = array(
            'post_type'     => 'prodotti',
            'post__in'      => $product_ids,
            'fields'        => 'ids',
            'tax_query'     => array(
                    array(
                        'taxonomy' => 'misure',
                        'field' => 'term_id',
                        'terms' => $misure_terms_id_1,
                    ),
            ),
        );
        
        $mis_query_1    = new WP_Query($mis_args_1);
       

        if ($mis_query_1->have_posts()) {
            $total_mis_1_posts = $mis_query_1->posts;
            foreach ($total_mis_1_posts as $single_mis_1_post_id) {
                $pass_min_val[]   = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_altezza', true);
                $pass_max_val[]   = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_altezza_max', true);
                $largh_min_val[]  = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_larghezza', true);
                $largh_max_val[]  = get_post_meta($single_mis_1_post_id, 'luce_di_passaggio_larghezza_max', true);
            }
        }
        // ---------- end one ---------------------
        $final_pass_min     = min($pass_min_val);
        $final_pass_max     = max($pass_max_val);
        $final_largh_min    = min($largh_min_val);
        $final_largh_max    = max($largh_max_val);
    }
    
    
    // 0 for "Ingombro"
    
    $ing_alt_min_val        = [];
    $ing_alt_max_val        = [];
    $ing_larg_min_val       = [];
    $ing_larg_max_val       = [];
    $final_ing_alt_min      = 0;
    $final_ing_alt_max      = 0;
    $final_ing_larg_min     = 0;
    $final_ing_larg_max     = 0;

    if(in_array($misure_terms_id_0,$misure_ids)){
        $mis_args_0 = array(
            'post_type'     => 'prodotti',
            'post__in'      => $product_ids,
            'fields'        => 'ids',
            'tax_query'     => array(
                    array(
                        'taxonomy'  => 'misure',
                        'field'     => 'term_id',
                        'terms'     => $misure_terms_id_0,
                    ),
            ),
        );
        $mis_query_0 = new WP_Query($mis_args_0);

        

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
    }
    // ---------- end two ---------------------
    /**
    * End misure
    */
    $data['final_pass_min']         = $final_pass_min;
    $data['final_pass_max']         = $final_pass_max;
    $data['final_largh_min']        = $final_largh_min;
    $data['final_largh_max']        = $final_largh_max;
    $data['final_ing_alt_min']      = $final_ing_alt_min;
    $data['final_ing_alt_max']      = $final_ing_alt_max;
    $data['final_ing_larg_min']     = $final_ing_larg_min;
    $data['final_ing_larg_max']     = $final_ing_larg_max;
    $data['misure_terms_name_0']    = $misure_terms_name_0;
    $data['misure_terms_name_1']    = $misure_terms_name_1;
    return $data;
}

function get_misure_terms_values(){

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
    
    $data['final_pass_min']         = $final_pass_min;
    $data['final_pass_max']         = $final_pass_max;
    $data['final_largh_min']        = $final_largh_min;
    $data['final_largh_max']        = $final_largh_max;
    $data['final_ing_alt_min']      = $final_ing_alt_min;
    $data['final_ing_alt_max']      = $final_ing_alt_max;
    $data['final_ing_larg_min']     = $final_ing_larg_min;
    $data['final_ing_larg_max']     = $final_ing_larg_max;
    $data['misure_terms_name_0']    = $misure_terms_name_0;
    $data['misure_terms_name_1']    = $misure_terms_name_1;
    return $data;
}
function product_filter_form_action()
{
    $sliderFilterItems = array();
    if(isset($_POST['slider_filter_items']))
    {
        $sliderFilterItemsJSON  = urldecode($_POST['slider_filter_items']);
        $sliderFilterItems      = json_decode($sliderFilterItemsJSON, true);
    }
    


    $meta_query = array();
    $meta_query_index = 0;
    if(count($sliderFilterItems) > 0){
        foreach($sliderFilterItems as $sliderFilterItem){
            $min_max_val    = $sliderFilterItem['min_max_val'];
            $term_filter_id = $sliderFilterItem['term_filter_id'];
            $slider_name    = $sliderFilterItem['slider_name'];

            if($slider_name == 'altezza'){
                $meta_query[$meta_query_index] = array(
                    'relation' => 'AND',
                        array(
                            'key' => 'luce_di_passaggio_altezza',
                            'value' => $min_max_val[0],
                            'compare' => '>=',
                        ),
                        array(
                            'key' => 'luce_di_passaggio_altezza_max',
                            'value' => $min_max_val[1],
                            'compare' => '<=',
                        )
                    );
            }
            if($slider_name == 'larghezza'){
                $meta_query[$meta_query_index] = array(
                    'relation' => 'AND',
                        array(
                            'key' => 'luce_di_passaggio_larghezza',
                            'value' => $min_max_val[0],
                            'compare' => '>=',
                        ),
                        array(
                            'key' => 'luce_di_passaggio_larghezza_max',
                            'value' => $min_max_val[1],
                            'compare' => '<=',
                        )
                    );
            }
            if($slider_name == 'ingaltezza'){
                $meta_query[$meta_query_index] = array(
                    'relation' => 'AND',
                        array(
                            'key' => 'ingombro_altezza',
                            'value' => $min_max_val[0],
                            'compare' => '>=',
                        ),
                        array(
                            'key' => 'ingombro_altezza_max',
                            'value' => $min_max_val[1],
                            'compare' => '<=',
                        )
                    );
            }
            if($slider_name == 'inglarghezza'){
                $meta_query[$meta_query_index] = array(
                    'relation' => 'AND',
                        array(
                            'key' => 'ingombro_larghezza',
                            'value' => $min_max_val[0],
                            'compare' => '>=',
                        ),
                        array(
                            'key' => 'ingombro_larghezza_max',
                            'value' => $min_max_val[1],
                            'compare' => '<=',
                        )
                    );
            }
            $meta_query_index++;
        }
    }
    
    $collection_main_cat_id = 44;
    $orderby            = isset($_POST['orderby']) ? $_POST['orderby'] :  '';
    $asc_order_checked = '';
    $desc_order_checked = '';
    if($orderby == 'ASC'){
        $asc_order_checked = 'checked';
    }
    if($orderby == 'DESC'){
        $desc_order_checked = 'checked';
    }
    $product_args = [
        'post_type' => 'prodotti',
        'posts_per_page' => -1,
    ];

    if(count($meta_query) > 0){
        $product_args['meta_query'] = $meta_query;
    }
    
    $filter_taxonomies = [

        [

            'taxonomy_name'     => 'special-category',
            'id'                => 'ordinamento',
            'display_name'      => 'ordinamento',
            'display_class'     => '',

        ],

        [

            'taxonomy_name'     => 'in-out',
            'id'                => 'inout',
            'display_name'      => 'in /out',
            'display_class'     => 'display_in_out_terms',

        ],

        [

            'taxonomy_name'     => 'tipo-di-parete',
            'id'                => 'tipodiparete',
            'display_name'      => 'tipo di parete',
            'display_class'     => 'display_di_parete_terms',

        ],

        [

            'taxonomy_name'     => 'tipo-di-apertura',
            'id'                => 'tipodiapertura',
            'display_name'      => 'tipo di apertura',
            'display_class'     => 'display_di_apertura_terms',

        ],

        [

            'taxonomy_name'     => 'misure',
            'id'                => 'misure',
            'display_name'      => 'misure',
            'display_class'     => '',

        ],

        [

            'taxonomy_name'     => 'collezione',
            'id'                => 'tipodisupporto',
            'display_name'      => 'tipo di supporto',
            'display_class'     => '',

        ],
        [

            'taxonomy_name'     => 'collezione',
            'id'                => 'collezione',
            'display_name'      => 'COLLEZIONE',
            'display_class'     => '',

        ],

        [

            'taxonomy_name'     => 'colore',
            'id'                => 'colore',
            'display_name'      => 'colore',
            'display_class'     => '',

        ],

    ];

    $tax_inc = 0;

    foreach ($filter_taxonomies as $single_taxonomy) {

        $tax_name = $single_taxonomy['taxonomy_name'];

        if (isset($_POST[$tax_name])) {

            $term_ids = $_POST[$tax_name];

            $product_args['tax_query'][$tax_inc] = [

                'taxonomy' => $tax_name,

                'field' => 'term_id',

                'terms' => $term_ids,

            ];

            $tax_inc++;

        }

    }

    $pro_query      = new wp_query($product_args);
    $products       = $pro_query->posts;
    $product_ids    = wp_list_pluck($products, 'ID');

    $selected_terms     = wp_get_object_terms($product_ids, 'collezione');
    $total_selected_ids = count($selected_terms);
    $terms_n_posts      = '';

    if ($total_selected_ids > 0) {

        foreach ($selected_terms as $selected_term) {

            if ($selected_term->parent == $collection_main_cat_id){

                $parent_id      = $selected_term->term_id;
                $parent_name    = $selected_term->name;

                $get_child_terms = get_terms(

                    array(

                        'taxonomy'      => 'collezione',
                        'parent'        => $parent_id,
                        'hide_empty'    => false

                    ),

                );

                foreach ($get_child_terms as $single_shild) {

                    $child_term_id      = $single_shild->term_id ?? '';
                    $child_term_name    = $single_shild->name ?? '';

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
                    if($orderby){
                        $collec_args['orderby'] = 'title';
                        $collec_args['order']   = $orderby;
                    }
                    
                    $collec_query = new WP_Query($collec_args);

                    $terms_n_posts .= '<div class="collection-types-main">';
                    $terms_n_posts .= ' <h4> <strong>' . $parent_name . '</strong>-' . $child_term_name . '</h4>';
                    $terms_n_posts .= ' <div class="collections-grid-main">';

                    if ($collec_query->have_posts()) {

                        while ($collec_query->have_posts()) {

                            $collec_query->the_post();
                            $post_id        = get_the_ID();
                            $product_url    = get_the_permalink();
                            $image_url      = site_url() . '/wp-content/uploads/2023/12/default.png';
                            if (has_post_thumbnail()) {
                                $image_url = get_the_post_thumbnail_url($post_id);
                            }

                            $pkt_short_description  = get_field('pkt_short_description');
                            $post_title             = get_the_title();

                            $terms_n_posts .= '

                            <div class="single-collection">
                            <a href="' . $product_url . '"></a>
                            <div class="image-box">
                            <img src="' . $image_url . '" alt="">
                                <div class="content-box">
                                    <div class="content">
                                        <p>' . $pkt_short_description . '</p>
                                        <h5>
                                            <a href="">' . $post_title . '</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                            ';
                        }

                    }
                    $terms_n_posts .= '</div>';
                    $terms_n_posts .= '</div>';

                }
            }
        }
    }
    if($terms_n_posts == ''){
        $terms_n_posts = '<div style="margin-top: 45px;" class="alert alert-danger" role="alert">
                            Dati non trovati!
                        </div>';
    }
    $is_lc_passaggio_term_id   = false;
    $is_ing_ingombro_term_id   = false;
    $left_side_html = '';
    foreach ($filter_taxonomies as $single_taxonomy) {
        $taxonomy_name      = $single_taxonomy['taxonomy_name'];
        $html_id            = $single_taxonomy['id'];
        $display_name       = $single_taxonomy['display_name'];
        $display_class      = $single_taxonomy['display_class'];

        $post_terms         = wp_get_object_terms($product_ids, $taxonomy_name);
        $clicked_terms      = isset($_POST[$taxonomy_name]) ? $_POST[$taxonomy_name] : array();
        
        if($taxonomy_name != 'misure'){
            $is_products_into_terms = 0;
            foreach($post_terms as $post_term){
                if($post_term->count > 0){
                    $is_products_into_terms++;
                }
            }
            
            if($is_products_into_terms > 0){
                $left_side_html .= '<div class="accordion-item show_hide_in_out">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#'.$html_id.'" aria-expanded="true" aria-controls="'.$html_id.'">'.$display_name.'</button>
                                        </h2>
                                        <div id="'.$html_id.'" class="accordion-collapse collapse show">
                                            <div class="accordion-body '.$display_class.'" term_taxonomy_name="'.$taxonomy_name.'">';

                                            if($taxonomy_name == 'special-category'){
                                                $left_side_html .= '<div class="double-checks">
                                                                        <div class="single-checkbox">
                                                                            <div class="form-check">
                                                                                <input '.$asc_order_checked.' value="ASC" name="orderby" class="term_filter_class_input" type="checkbox" id="az">
                                                                                <label for="az"> A/Z </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-checkbox">
                                                                            <div class="form-check">
                                                                                <input '.$desc_order_checked.' value="DESC" name="orderby" class="term_filter_class_input" type="checkbox" id="za">
                                                                                <label for="za"> Z/A </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="display_special_term">';
                                                                    foreach ($post_terms as $post_term) {
                                                                        if($post_term->count > 0){
                                                                            $p_term_id         = $post_term->term_id;
                                                                            $p_term_name       = $post_term->name;
                                                                            $is_checked        = '';
                            
                                                                            if (in_array($p_term_id, $clicked_terms)) {$is_checked = 'checked';}
                                                                    
                                                                            $left_side_html .= '
                                                                    
                                                                                <div class="single-checkbox">
                                                                                    <div class="form-check">
                                                                                        <input ' . $is_checked . ' name="'.$taxonomy_name.'[]" value="' . $p_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $p_term_id . '">
                                                                                        <label class="term_filter_class" for="term_id_' . $p_term_id . '"> ' . $p_term_name . ' </label>
                                                                                    </div>
                                                                                </div>
                                                                            ';
                                                                        }
                                                                
                                                                    }
                                                                    $left_side_html .= '</div>';
                                            }elseif($taxonomy_name == 'collezione'){
                                                if($html_id == 'tipodisupporto'){
                                                    foreach ($post_terms as $post_term) {
                                                        if($post_term->parent != 0 && $post_term->parent != $collection_main_cat_id){
                                                            if($post_term->count > 0){
                                                                $p_term_id         = $post_term->term_id;
                                                                $p_term_name       = $post_term->name;
                                                                $is_checked        = '';
                
                                                                if (in_array($p_term_id, $clicked_terms)) {$is_checked = 'checked';}
                                                        
                                                                $left_side_html .= '
                                                        
                                                                    <div class="single-checkbox">
                                                                        <div class="form-check">
                                                                            <input ' . $is_checked . ' name="'.$taxonomy_name.'[]" value="' . $p_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $p_term_id . '">
                                                                            <label class="term_filter_class" for="term_id_' . $p_term_id . '"> ' . $p_term_name . ' </label>
                                                                        </div>
                                                                    </div>
                                                                ';
                                                            }
                                                        }
                                                    }
                                                }else{
                                                    foreach ($post_terms as $post_term) {

                                                        if($post_term->parent == $collection_main_cat_id){
                                                            if($post_term->count > 0){
                                                                $p_term_id         = $post_term->term_id;
                                                                $p_term_name       = $post_term->name;
                                                                $is_checked        = '';
                
                                                                if (in_array($p_term_id, $clicked_terms)) {$is_checked = 'checked';}
                                                        
                                                                $left_side_html .= '
                                                        
                                                                    <div class="single-checkbox">
                                                                        <div class="form-check">
                                                                            <input ' . $is_checked . ' name="'.$taxonomy_name.'[]" value="' . $p_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $p_term_id . '">
                                                                            <label class="term_filter_class" for="term_id_' . $p_term_id . '"> ' . $p_term_name . ' </label>
                                                                        </div>
                                                                    </div>
                                                                ';
                                                            }
                                                        }
                                                
                                                    }
                                                }
                                            }else{
                                                foreach ($post_terms as $post_term) {
                                                    if($post_term->count > 0){
                                                        $p_term_id         = $post_term->term_id;
                                                        $p_term_name       = $post_term->name;
                                                        $is_checked        = '';

                                                        if (in_array($p_term_id, $clicked_terms)) {$is_checked = 'checked';}
                                                
                                                        $left_side_html .= '
                                                
                                                            <div class="single-checkbox">
                                                                <div class="form-check">
                                                                    <input ' . $is_checked . ' name="'.$taxonomy_name.'[]" value="' . $p_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $p_term_id . '">
                                                                    <label class="term_filter_class" for="term_id_' . $p_term_id . '"> ' . $p_term_name . ' </label>
                                                                </div>
                                                            </div>
                                                        ';
                                                    }
                                                }
                                            }
                                                
                $left_side_html .= '</div></div></div>';
            }
        }else{
            
            // $misure_infos = get_misure_terms_values_by_posts($product_ids,$post_terms);
            $misure_infos           = get_misure_terms_values();
            $final_pass_min         = $misure_infos['final_pass_min'];
            $final_pass_max         = $misure_infos['final_pass_max'];
            $final_largh_min        = $misure_infos['final_largh_min'];
            $final_largh_max        = $misure_infos['final_largh_max'];
            $final_ing_alt_min      = $misure_infos['final_ing_alt_min'];
            $final_ing_alt_max      = $misure_infos['final_ing_alt_max'];
            $final_ing_larg_min     = $misure_infos['final_ing_larg_min'];
            $final_ing_larg_max     = $misure_infos['final_ing_larg_max'];
            $misure_terms_name_1    = $misure_infos['misure_terms_name_1'];
            $misure_terms_name_0    = $misure_infos['misure_terms_name_0'];
            $lc_passaggio_term_id   = get_field('lc_passaggio_term_id', 'option');
            $ing_ingombro_term_id   = get_field('ing_ingombro_term_id', 'option');
            $misure_term_ids        = wp_list_pluck($post_terms, 'term_id');
            $selected_final_pass_min         = $final_pass_min;
            $selected_final_pass_max         = $final_pass_max;
            $selected_final_largh_min        = $final_largh_min;
            $selected_final_largh_max        = $final_largh_max;
            $selected_final_ing_alt_min      = $final_ing_alt_min;
            $selected_final_ing_alt_max      = $final_ing_alt_max;
            $selected_final_ing_larg_min     = $final_ing_larg_min;
            $selected_final_ing_larg_max     = $final_ing_larg_max;

            if(count($sliderFilterItems) > 0){
                foreach($sliderFilterItems as $sliderFilterItem){
                    $min_max_val    = $sliderFilterItem['min_max_val'];
                    $term_filter_id = $sliderFilterItem['term_filter_id'];
                    $slider_name    = $sliderFilterItem['slider_name'];
                    if($slider_name == 'altezza'){
                        $selected_final_pass_min         = $min_max_val[0];
                        $selected_final_pass_max         = $min_max_val[1];
                    }
                    if($slider_name == 'larghezza'){
                        $selected_final_largh_min         = $min_max_val[0];
                        $selected_final_largh_max         = $min_max_val[1];
                    }
                    if($slider_name == 'ingaltezza'){
                        $selected_final_ing_alt_min         = $min_max_val[0];
                        $selected_final_ing_alt_max         = $min_max_val[1];
                    }
                    if($slider_name == 'inglarghezza'){
                        $selected_final_ing_larg_min         = $min_max_val[0];
                        $selected_final_ing_larg_max         = $min_max_val[1];
                    }
                    
                }
                $data['final_pass_min']         = $final_pass_min;
                $data['final_pass_max']         = $final_pass_max;
                $data['final_largh_min']        = $final_largh_min;
                $data['final_largh_max']        = $final_largh_max;
                $data['final_ing_alt_min']      = $final_ing_alt_min;
                $data['final_ing_alt_max']      = $final_ing_alt_max;
                $data['final_ing_larg_min']     = $final_ing_larg_min;
                $data['final_ing_larg_max']     = $final_ing_larg_max;
                $data['misure_terms_name_0']    = $misure_terms_name_0;
                $data['misure_terms_name_1']    = $misure_terms_name_1;
                // echo '<pre>';
                // print_r($data);
                // print_r($sliderFilterItems);
            }
            
            // die;
            if(count($post_terms) > 0){
                $left_side_html .= '<div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#misure" aria-expanded="true" aria-controls="misure">misure</button>
                                        </h2>
                                        <div id="misure" class="accordion-collapse collapse show">
                                        <div class="accordion-body">';
                // if(in_array($lc_passaggio_term_id,$misure_term_ids)){
                $is_lc_passaggio_term_id   = true;
                $left_side_html .= '
                                        <input type="hidden" id="luce_term_id" value="'.$lc_passaggio_term_id.'">
                                        <input class="final_pass_min" type="hidden" selected_value="'.$selected_final_pass_min.'" value="'.$final_pass_min.'">
                                        <input class="final_pass_max" type="hidden" selected_value="'.$selected_final_pass_max.'" value="'.$final_pass_max.'">
                                        <input class="final_largh_min" type="hidden" selected_value="'.$selected_final_largh_min.'" value="'.$final_largh_min.'">
                                        <input class="final_largh_max" type="hidden" selected_value="'.$selected_final_largh_max.'" value="'.$final_largh_max.'">
                                        <div class="passaggio-box">
                                            <div class="title">'.$misure_terms_name_1.'</div>
                                            <div class="price-range-slider">
                                                <div class="test">
                                                    <div class="subtitle-flex">
                                                        <div class="subtitle">altezza</div>
                                                        <div class="allvalue-boxes">
                                                            <span id="altezza-value1" class="value"></span>
                                                            <span id="separtor">-</span>
                                                            <span id="altezza-value2" class="value "></span>
                                                        </div>
                                                    </div>
                                                    <div id="altezza"></div>
                                                </div>
                                                <div class="hidden-range-input">
                                                    <input type="hidden" id="altezza-min-value">
                                                    <input type="hidden" id="altezza-max-value">
                                                </div>
                                            </div>
                                            <div class="price-range-slider">
                                                <div class="test">
                                                    <div class="subtitle-flex">
                                                        <div class="subtitle">larghezza</div>
                                                        <div class="allvalue-boxes">
                                                            <span id="larghezza-value1" class="value"></span>
                                                            <span id="separtor">-</span>
                                                            <span id="larghezza-value2" class="value"></span>
                                                        </div>
                                                    </div>
                                                    <div id="larghezza"></div>
                                                </div>
                                                <div class="hidden-range-input">
                                                    <input type="hidden" id="larghezza-min-value">
                                                    <input type="hidden" id="larghezza-max-value">
                                                </div>
                                            </div>
                                        </div>';
                // }
                // if(in_array($ing_ingombro_term_id,$misure_term_ids)){
                $is_ing_ingombro_term_id   = true;
                $left_side_html.=       '<input type="hidden" id="ingo_term_id" value="'.$ing_ingombro_term_id.'">
                                        <input class="final_ing_alt_min" type="hidden" selected_value="'.$selected_final_ing_alt_min.'" value="'.$final_ing_alt_min.'">
                                        <input class="final_ing_alt_max" type="hidden" selected_value="'.$selected_final_ing_alt_max.'" value="'.$final_ing_alt_max.'">
                                        <input class="final_ing_larg_min" type="hidden" selected_value="'.$selected_final_ing_larg_min.'" value="'.$final_ing_larg_min.'">
                                        <input class="final_ing_larg_max" type="hidden" selected_value="'.$selected_final_ing_larg_max.'" value="'.$final_ing_larg_max.'">
                                        <div class="ingombro-box">
                                            <div class="title">'.$misure_terms_name_0.'</div>
                                            <div class="price-range-slider">
                                                <div class="test">
                                                    <div class="subtitle-flex">
                                                        <div class="subtitle">altezza</div>
                                                        <div class="allvalue-boxes">
                                                            <span id="ingaltezza-value1" class="value"></span>
                                                            <span id="separtor">-</span>
                                                            <span id="ingaltezza-value2" class="value"></span>
                                                        </div>
                                                    </div>
                                                    <div id="ingaltezza"></div>
                                                </div>
                                                <div class="hidden-range-input">
                                                    <input type="hidden" id="ingaltezza-min-value">
                                                    <input type="hidden" id="ingaltezza-max-value">
                                                </div>
                                            </div>
                                            <div class="price-range-slider">
                                                <div class="test">
                                                    <div class="subtitle-flex">
                                                        <div class="subtitle">larghezza</div>
                                                        <div class="allvalue-boxes">
                                                            <span id="inglarghezza-value1" class="value"></span>
                                                            <span id="separtor">-</span>
                                                            <span id="inglarghezza-value2" class="value"></span>
                                                        </div>
                                                    </div>
                                                    <div id="inglarghezza"></div>
                                                </div>
                                                <div class="hidden-range-input">
                                                    <input type="hidden" id="inglarghezza-min-value">
                                                    <input type="hidden" id="inglarghezza-max-value">
                                                </div>
                                            </div>
                                        </div>';
                // }
                $left_side_html .= '</div></div></div>';
            }
        }
    }
    // start special terms 

    $special_terms          = wp_get_object_terms($product_ids, 'special-category');

    $special_term_list      = '';

    $clicked_sp_terms       = isset($_POST['special-category']) ? $_POST['special-category'] : array();



    foreach ($special_terms as $special_term) {

        $sp_term_id         = $special_term->term_id;

        $sp_term_name       = $special_term->name;

        $cpecial_checked    = '';



        if (in_array($sp_term_id, $clicked_sp_terms)) {

            $cpecial_checked = 'checked';

        }



        $special_term_list .= '

            <div class="single-checkbox">

                <div class="form-check">

                    <input ' . $cpecial_checked . ' name="special-category[]" value="' . $sp_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $sp_term_id . '">

                    <label class="term_filter_class" for="term_id_' . $sp_term_id . '"> ' . $sp_term_name . ' </label>

                </div>

            </div>

        ';

    }

    // end special terms 



    // start special terms 

    $in_out_terms          = wp_get_object_terms($product_ids, 'in-out');

    $in_out_term_list      = '';

    $clicked_in_out_ids    = isset($_POST['in-out']) ? $_POST['in-out'] : array();



    foreach ($in_out_terms as $in_out_term) {

        $in_out_term_id         = $in_out_term->term_id;

        $in_out_term_name       = $in_out_term->name;

        $in_out_checked    = '';



        if (in_array($in_out_term_id, $clicked_in_out_ids)) {

            $in_out_checked = 'checked';

        }



        $in_out_term_list .= '

            <div class="single-checkbox">

                <div class="form-check">

                    <input ' . $in_out_checked . ' name="in-out[]" value="' . $in_out_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $in_out_term_id . '">

                    <label class="term_filter_class" for="term_id_' . $in_out_term_id . '"> ' . $in_out_term_name . ' </label>

                </div>

            </div>

        ';

    }

    // end special terms 



    // start special terms 

    $di_parete_terms          = wp_get_object_terms($product_ids, 'tipo-di-parete');

    $di_parete_list      = '';

    $clicked_di_parete_ids    = isset($_POST['tipo-di-parete']) ? $_POST['tipo-di-parete'] : array();



    foreach ($di_parete_terms as $di_parete_term) {

        $di_parete_term_id         = $di_parete_term->term_id;

        $di_parete_term_name       = $di_parete_term->name;

        $di_parete_checked    = '';



        if (in_array($di_parete_term_id, $clicked_di_parete_ids)) {

            $di_parete_checked = 'checked';

        }



        $di_parete_list .= '

            <div class="single-checkbox">

                <div class="form-check">

                    <input ' . $di_parete_checked . ' name="tipo-di-parete[]" value="' . $di_parete_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $di_parete_term_id . '">

                    <label class="term_filter_class" for="term_id_' . $di_parete_term_id . '"> ' . $di_parete_term_name . ' </label>

                </div>

            </div>

        ';

    }

    // end special terms 



    // start special terms 

    $di_apertura_terms          = wp_get_object_terms($product_ids, 'tipo-di-apertura');

    $di_apertura_list      = '';

    $clicked_di_apertura_ids    = isset($_POST['tipo-di-apertura']) ? $_POST['tipo-di-apertura'] : array();



    foreach ($di_apertura_terms as $di_apertura_term) {

        $di_apertura_term_id         = $di_apertura_term->term_id;

        $di_apertura_term_name       = $di_apertura_term->name;

        $di_apertura_checked    = '';



        if (in_array($di_apertura_term_id, $clicked_di_apertura_ids)) {

            $di_apertura_checked = 'checked';

        }



        $di_apertura_list .= '

                <div class="single-checkbox">

                    <div class="form-check">

                        <input ' . $di_apertura_checked . ' name="tipo-di-apertura[]" value="' . $di_apertura_term_id . '" class="term_filter_class_input" type="checkbox" id="term_id_' . $di_apertura_term_id . '">

                        <label class="term_filter_class" for="term_id_' . $di_apertura_term_id . '"> ' . $di_apertura_term_name . ' </label>

                    </div>

                </div>

            ';

    }

    // end special terms 





    $response['results']    = array(
        'post_tems'                 => $terms_n_posts,
        'special_term_list'         => $special_term_list,
        'in_out_term_list'          => $in_out_term_list,
        'di_parete_list'            => $di_parete_list,
        'di_apertura_list'          => $di_apertura_list,
        'left_side_html'            => $left_side_html,
        'is_lc_passaggio_term_id'   => $is_lc_passaggio_term_id,
        'is_ing_ingombro_term_id'   => $is_ing_ingombro_term_id
    );
    echo  json_encode($response);
    die;

}

