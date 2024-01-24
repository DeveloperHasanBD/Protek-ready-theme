<?php



include_once("functionalities/left-side-profeccing.php");



/**

 * Passed processing data from 'left-side-profeccing.php'

 * =====================================================

 * 

 * collezione

 * ===========================

 * 1. $c_parent_list //  Array 

 * 2. $c_child_list //  Array  

 * 

 * IN /OUT

 * =======

 * 1. $in_out_terms //  Array

 * 2. $total_in_out // number

 * 

 * 

 * tipo-di-parete

 * =======

 * 1. $di_parete_terms //  Array

 * 2. $total_di_parete // number

 * 

 * 

 * tipo-di-apertura

 * =======

 * 1. $di_apertura_terms //  Array

 * 2. $total_di_apertura // number

 * 

 * 

 * colore

 * =======

 * 1. $colore_terms //  Array

 * 2. $total_colore // number

 * 

 * 

 * misure

 * =======

 * 1. $misure_term_id_name //  Array

 * 2. $total_misure_name // number

 * 

 * 

 * special terms

 * =============

 * 1. $special_terms //  Array

 * 2. $total_special // number

 * 

 * 

 */







?>





<div class="filter-main">

    <div class="filter-title">

        <h4>filtri </h4>

    </div>



    <!-- <form>

        <div>

            <input name="special-category[]" id="spc_40" value="40"/>

            <label  class="tax_filter_label" for="spc_40">Test</label>

        </div>

    </form> -->

    <form action="" id="product_filter_form">

        <div class="accordion" id="accordionPanelsStayOpenExample">

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ordinamento" aria-expanded="true" aria-controls="ordinamento">

                        ordinamento

                    </button>

                </h2>

                <div id="ordinamento" class="accordion-collapse collapse show">

                    <div class="accordion-body" term_taxonomy_name="special-category">

                        <div class="double-checks">

                            <div class="single-checkbox">

                                <div class="form-check">

                                    <input value="ASC" name="orderby" class="term_filter_class_input" type="checkbox" id="az">

                                    <label for="az"> A/Z </label>

                                </div>

                            </div>

                            <div class="single-checkbox">

                                <div class="form-check">

                                    <input value="DESC" name="orderby" class="term_filter_class_input" type="checkbox" id="za">

                                    <label for="za"> Z/A </label>

                                </div>

                            </div>

                        </div>

                        <div class="display_special_term">

                            <?php

                            if ($total_special > 0 && $is_products_special_term > 0) {

                                foreach ($special_terms as $single_special) {
                                    if($single_special->count > 0){
                                    $special_term_id     = $single_special->term_id ?? '';

                                    $special_term_name   = $single_special->name ?? '';

                            ?>

                                    <div class="single-checkbox">

                                        <div class="form-check">

                                            <input name="special-category[]" value="<?php echo $special_term_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $special_term_id; ?>">

                                            <label class="term_filter_class" for="term_id_<?php echo $special_term_id; ?>"> <?php echo $special_term_name; ?> </label>

                                        </div>

                                    </div>

                            <?php

                                }}

                            }



                            ?>

                        </div>



                    </div>

                </div>

            </div>

            <?php



            if ($total_in_out > 0 && $is_products_in_out_terms > 0) {

            ?>

                <div class="accordion-item show_hide_in_out">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#inout" aria-expanded="true" aria-controls="inout">

                            in /out

                        </button>

                    </h2>

                    <div id="inout" class="accordion-collapse collapse show">

                        <div class="accordion-body display_in_out_terms">

                            <?php

                            foreach ($in_out_terms as $single_in_out) {
                                if($single_in_out->count > 0){
                                $in_out_term_id     = $single_in_out->term_id ?? '';

                                $in_out_term_name   = $single_in_out->name ?? '';

                            ?>

                                <div class="single-checkbox">

                                    <div class="form-check">

                                        <input name="in-out[]" value="<?php echo $in_out_term_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $in_out_term_id; ?>">

                                        <label class="term_filter_class" for="term_id_<?php echo $in_out_term_id; ?>"> <?php echo $in_out_term_name; ?> </label>

                                    </div>

                                </div>

                            <?php

                            }}

                            ?>

                        </div>

                    </div>

                </div>

            <?php

            }





            if ($total_di_parete > 0 && $is_products_di_parete_terms > 0) {

            ?>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tipodiparete" aria-expanded="true" aria-controls="tipodiparete">

                            tipo di parete

                        </button>

                    </h2>

                    <div id="tipodiparete" class="accordion-collapse collapse show">



                        <div class="accordion-body display_di_parete_terms">

                            <?php

                            foreach ($di_parete_terms as $single_di_parete) {
                                if($single_di_parete->count > 0){
                                $di_parete_term_id     = $single_di_parete->term_id ?? '';

                                $di_parete_term_name   = $single_di_parete->name ?? '';

                            ?>

                                <div class="single-checkbox">

                                    <div class="form-check">

                                        <input name="tipo-di-parete[]" value="<?php echo $di_parete_term_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $di_parete_term_id; ?>">

                                        <label class="term_filter_class" for="term_id_<?php echo $di_parete_term_id; ?>"> <?php echo $di_parete_term_name; ?> </label>

                                    </div>

                                </div>

                            <?php

                            }}

                            ?>

                        </div>

                    </div>

                </div>

            <?php

            }





            if ($total_di_apertura > 0 && $is_products_di_apertura_terms > 0) {

            ?>

                <div class="accordion-item show_hide_di_apertura">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tipodiapertura" aria-expanded="true" aria-controls="tipodiapertura">

                            tipo di apertura

                        </button>

                    </h2>

                    <div id="tipodiapertura" class="accordion-collapse collapse show">

                        <div class="accordion-body display_di_apertura_terms">

                            <?php

                            foreach ($di_apertura_terms as $single_di_apertura) {

                                if ($single_di_apertura->count > 0) {

                                    $di_apertura_term_id     = $single_di_apertura->term_id ?? '';

                                    $di_apertura_term_name   = $single_di_apertura->name ?? '';

                            ?>

                                    <div class="single-checkbox">

                                        <div class="form-check">

                                            <input name="tipo-di-apertura[]" value="<?php echo $di_apertura_term_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $di_apertura_term_id; ?>">

                                            <label class="term_filter_class" for="term_id_<?php echo $di_apertura_term_id; ?>"> <?php echo $di_apertura_term_name; ?> </label>

                                        </div>

                                    </div>

                            <?php

                                }

                            }

                            ?>

                        </div>

                    </div>

                </div>

            <?php



            }



            /**

             * start misure

             */



            if ($total_misure_name > 0 && $is_products_misure_terms > 0) {

            ?>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#misure" aria-expanded="true" aria-controls="misure">

                            misure

                        </button>

                    </h2>

                    <div id="misure" class="accordion-collapse collapse show">

                        <div class="accordion-body">

                            <!-- 1 val for "LUCE DI PASSAGGIO" -->

                            <input type="hidden" id="luce_term_id" value="<?php echo get_field('lc_passaggio_term_id', 'option') ?>">

                            <input class="final_pass_min" type="hidden" value="<?php echo $final_pass_min; ?>">

                            <input class="final_pass_max" type="hidden" value="<?php echo $final_pass_max; ?>">

                            <input class="final_largh_min" type="hidden" value="<?php echo $final_largh_min; ?>">

                            <input class="final_largh_max" type="hidden" value="<?php echo $final_largh_max; ?>">



                            <div class="passaggio-box">

                                <div class="title"><?php echo $misure_terms_name_1; ?></div>

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

                            </div>

                            <!-- end item  -->

                            <input type="hidden" id="ingo_term_id" value="<?php echo get_field('ing_ingombro_term_id', 'option') ?>">

                            <input class="final_ing_alt_min" type="hidden" value="<?php echo $final_ing_alt_min; ?>">

                            <input class="final_ing_alt_max" type="hidden" value="<?php echo $final_ing_alt_max; ?>">

                            <input class="final_ing_larg_min" type="hidden" value="<?php echo $final_ing_larg_min; ?>">

                            <input class="final_ing_larg_max" type="hidden" value="<?php echo $final_ing_larg_max; ?>">



                            <div class="ingombro-box">

                                <div class="title"><?php echo $misure_terms_name_0; ?></div>

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

                            </div>

                            <!-- end item  -->





                        </div>

                    </div>

                </div>

            <?php



            }



            /**

             * end misure

             */



            /**

             * start collection child

             */



            $total_child = count($c_child_list);

            if ($total_child > 0 && $is_product_c_child_terms > 0) {

            ?>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tipodisupporto" aria-expanded="true" aria-controls="tipodisupporto">

                            tipo di supporto

                        </button>

                    </h2>

                    <div id="tipodisupporto" class="accordion-collapse collapse show">

                        <div class="accordion-body" term_taxonomy_name="collezione">



                            <?php



                            foreach ($c_child_list as $c_child_info) {
                                if($c_child_info['count'] > 0){
                                $c_child_id    = $c_child_info['c_child_id'] ?? '';

                                $c_child_name  = $c_child_info['c_child_name'] ?? '';

                            ?>

                                <div class="single-checkbox">

                                    <div class="form-check">

                                        <input name="collezione[]" value="<?php echo $c_child_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $c_child_id; ?>">

                                        <label class="term_filter_class" for="term_id_<?php echo $c_child_id; ?>"> <?php echo $c_child_name; ?> </label>

                                    </div>

                                </div>

                            <?php

                            }}

                            ?>



                        </div>

                    </div>

                </div>

            <?php

            }



            /**

             * end collection child

             */



            /**

             * start sollection parent

             */



            $total_parent = count($c_parent_list);

            if ($total_parent > 0 && $is_product_c_parent_terms > 0) {

            ?>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collezione" aria-expanded="true" aria-controls="collezione">

                            COLLEZIONE

                        </button>

                    </h2>

                    <div id="collezione" class="accordion-collapse collapse show">

                        <div class="accordion-body" term_taxonomy_name="collezione">



                            <?php



                            foreach ($c_parent_list as $c_parents_info) {
                                if($c_parents_info['count'] > 0){
                                $c_parent_id    = $c_parents_info['c_parent_id'] ?? '';

                                $c_parent_name  = $c_parents_info['c_parent_name'] ?? '';

                            ?>

                                <div class="single-checkbox">

                                    <div class="form-check">

                                        <input name="collezione[]" value="<?php echo $c_parent_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $c_parent_id; ?>">

                                        <label class="term_filter_class" for="term_id_<?php echo $c_parent_id; ?>"> <?php echo $c_parent_name; ?> </label>

                                    </div>

                                </div>

                            <?php

                            }}

                            ?>

                        </div>

                    </div>

                </div>

            <?php

            }



            /**

             * start sollection parent

             */





            /**

             * start colore

             */

            if ($total_colore > 0 && $is_products_colore_terms > 0) {



            ?>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#colore" aria-expanded="true" aria-controls="colore">

                            colore

                        </button>

                    </h2>

                    <div id="colore" class="accordion-collapse collapse show">

                        <div class="accordion-body" term_taxonomy_name="colore">



                            <?php

                            foreach ($colore_terms as $single_colore) {
                                if($single_colore->count > 0){
                                $colore_term_id     = $single_colore->term_id ?? '';

                                $colore_term_name   = $single_colore->name ?? '';

                            ?>

                                <div class="single-checkbox">

                                    <div class="form-check">

                                        <input name="colore[]" value="<?php echo $colore_term_id; ?>" class="term_filter_class_input" type="checkbox" id="term_id_<?php echo $colore_term_id; ?>">

                                        <label class="term_filter_class" for="term_id_<?php echo $colore_term_id; ?>"> <?php echo $colore_term_name; ?> </label>

                                    </div>

                                </div>

                            <?php

                            }}

                            ?>



                        </div>

                    </div>

                </div>

            <?php



            }



            /**

             * end colore

             */

            ?>





        </div>

    </form>

    <div class="filter-submit-btn">

        <a href="<?php echo site_url()?>/ricerca-avanzata/" class="">cerca</a>

    </div>

</div>