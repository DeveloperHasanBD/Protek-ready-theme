(function ($) {

    $(document).ready(function () {

        var url = action_url_ajax.ajax_url;
        let current_page = $(location).attr('href');
        if(current_page.indexOf("cart") !== -1){}
        var insert_term_ids     = [];
        let slider_filter_items = [];

        // $("body").delegate('#altezza', 'change', function (values,handle) {
        $("body").delegate('#area_download_caategories', 'change', function (e) {
            let val = $(this).val();
            if(val){
                const spinner = `<div class="text-center" style="height:150px">
                <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
                $('#area_download_section').html(spinner);
            
                $.ajax({
                    url: url,
                    data: {
                        action: 'get_categories_by_id',
                        category: val,
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.error == true) {
                            alert(data.message)
                        } else {
                            $('#area_download_sub_category').html(data.html);
                            $('#area_download_section').html(data.product);
                        }
                    }
                });
            }
        });
        $("body").delegate('#area_download_sub_category', 'change', function (e) {
            let val = $(this).val();
            if(val){
                const spinner = `<div class="text-center" style="height:150px">
                <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
                $('#area_download_section').html(spinner);
                $.ajax({
                    url: url,
                    data: {
                        action: 'get_products_by_sub_cat_id',
                        category: val,
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.error == true) {
                            alert(data.message)
                        } else {
                            $('#area_download_products').html(data.html);
                            $('#area_download_section').html(data.product);
                        }
                    }
                });
            }
        });
        $("body").delegate('#area_download_products', 'change', function (e) {
            let val = $(this).val();
            if(val){
                const spinner = `<div class="text-center" style="height:150px">
                <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
                $('#area_download_section').html(spinner);
                $.ajax({
                    url: url,
                    data: {
                        action: 'get_product_by_product_id',
                        product_id: val,
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.error == true) {
                            alert(data.message)
                        } else {
                            $('#area_download_section').html(data.product);
                        }
                    }
                });
            }
        });
        $("body").delegate('#serching_product', 'keyup', function (e) {
            let val = $(this).val();
            if(val){
                const spinner = `<div class="text-center" style="height:150px">
                <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
                $('#area_download_section').html(spinner);
                $.ajax({
                    url: url,
                    data: {
                        action: 'get_product_by_product_title',
                        search: val,
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.error == true) {
                            alert(data.message)
                        } else {
                            $('#area_download_section').html(data.product);
                        }
                    }
                });
            }
        });
        function check_slider_filter_items(min_max_val,term_filter_id,slider_name){
            if(slider_filter_items.length > 0){
                let item = {
                    min_max_val:min_max_val,
                    term_filter_id:term_filter_id,
                    slider_name:slider_name,
                }
                let is_item_exsist = false;
                for(let i = 0;i < slider_filter_items.length;i++){
                    if(term_filter_id == slider_filter_items[i].term_filter_id && slider_name == slider_filter_items[i].slider_name){
                        slider_filter_items[i].min_max_val = min_max_val;
                        is_item_exsist = true;
                    }
                }
                if(is_item_exsist === false){
                    slider_filter_items.push(item);
                }
            }else{
                let item = {
                    min_max_val:min_max_val,
                    term_filter_id:term_filter_id,
                    slider_name:slider_name,
                }
                slider_filter_items.push(item);
            }
            call_range_filter_ajax()
        } 

        const altezza = document.getElementById('altezza');
        altezza.noUiSlider.on('change', function (values, handle) {
            const slider_name = 'altezza';
            const term_filter_id = parseInt($("#luce_term_id").val());
            const min_max_val = values;
            check_slider_filter_items(min_max_val,term_filter_id,slider_name);
        });

        const larghezza = document.getElementById('larghezza');
        larghezza.noUiSlider.on('change', function (values, handle) {
            const slider_name = 'larghezza';
            const term_filter_id = parseInt($("#luce_term_id").val());
            if (insert_term_ids.indexOf(term_filter_id) === -1) {
                insert_term_ids.push(term_filter_id);
            }
            const min_max_val = values;
            check_slider_filter_items(min_max_val,term_filter_id,slider_name);
        });

        const ingaltezza = document.getElementById('ingaltezza');
        ingaltezza.noUiSlider.on('change', function (values, handle) {
            const slider_name = 'ingaltezza';
            const term_filter_id = parseInt($("#ingo_term_id").val());
            if (insert_term_ids.indexOf(term_filter_id) === -1) {
                insert_term_ids.push(term_filter_id);
            }
            const min_max_val = values;
            check_slider_filter_items(min_max_val,term_filter_id,slider_name);
        });


        const inglarghezza = document.getElementById('inglarghezza');
        inglarghezza.noUiSlider.on('change', function (values, handle) {
            const slider_name = 'inglarghezza';
            const term_filter_id = parseInt($("#ingo_term_id").val());
            if (insert_term_ids.indexOf(term_filter_id) === -1) {
                insert_term_ids.push(term_filter_id);
            }
            const min_max_val = values;
            check_slider_filter_items(min_max_val,term_filter_id,slider_name);
        });

        function call_range_filter_ajax(){
            var form = new FormData($('#product_filter_form')[0]);
            form.append("action", 'product_filter_form_action');
            form.append("slider_filter_items", encodeURIComponent(JSON.stringify(slider_filter_items)));
            jQuery.ajax({
                type: 'POST',
                url: url,
                data: form,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.error == true) {
                        alert(data.message);
                    } else {
                        console.log(data.results);
                        $(".display_filter_data").html(data.results.post_tems);
                        $("#accordionPanelsStayOpenExample").html(data.results.left_side_html);
                        range_slider(data.results.is_lc_passaggio_term_id,data.results.is_ing_ingombro_term_id);
                        
                    }
                },
            });
        }
        $("body").delegate('.term_filter_class_input', 'click', function (e) {

            const spinner = `<div class="text-center" style="height:150px">
            <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
            $('.display_filter_data').html(spinner);

            const input_id = $(this).attr('id');
            if ($(`#${input_id}`).prop("checked") == true) {
                $(`#${input_id}`).prop("checked", true);
            } else {
                $(`#${input_id}`).prop("checked", false);
            }

            let value = $(this).val();
            if (value == 'ASC') {
                $(`#za`).prop("checked", false);
            }
            if (value == 'DESC') {
                $(`#az`).prop("checked", false);
            }
            var form = new FormData($('#product_filter_form')[0]);
            form.append("action", 'product_filter_form_action');
            form.append("slider_filter_items", encodeURIComponent(JSON.stringify(slider_filter_items)));
            jQuery.ajax({
                type: 'POST',
                url: url,
                data: form,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.error == true) {
                        alert(data.message);
                    } else {
                        console.log(data.results);
                        $(".display_filter_data").html(data.results.post_tems);
                        $("#accordionPanelsStayOpenExample").html(data.results.left_side_html);
                        range_slider(data.results.is_lc_passaggio_term_id,data.results.is_ing_ingombro_term_id);
                    }
                },
            });
        });
        function range_slider(is_lc,is_ing) {
        
            $('.noUi-handle').on('click', function () {
                $(this).width(50);
            });
            var moneyFormat = wNumb({
                decimals: 0,
                thousand: ',',
                prefix: '',
            });
            

            // if(is_lc === true){    
                $final_pass_min = parseInt($(".final_pass_min").val());
                $final_pass_max = parseInt($(".final_pass_max").val());
                $final_largh_min = parseInt($(".final_largh_min").val());
                $final_largh_max = parseInt($(".final_largh_max").val());
                
                $selected_final_pass_min = parseInt($(".final_pass_min").attr('selected_value'));
                $selected_final_pass_max = parseInt($(".final_pass_max").attr('selected_value'));
                $selected_final_largh_min = parseInt($(".final_largh_min").attr('selected_value'));
                $selected_final_largh_max = parseInt($(".final_largh_max").attr('selected_value'));
                
                var altezzaSlider = document.getElementById('altezza');
                
                noUiSlider.create(altezzaSlider, {
                    start: [$selected_final_pass_min, $selected_final_pass_max],
                    step: 1,
                    range: {
                        min: [$final_pass_min],
                        max: [$final_pass_max],
                    },
                    format: moneyFormat,
                    connect: true,
                });
                
                // Set visual min and max values and also update value hidden form inputs
                
                altezzaSlider.noUiSlider.on('update', function (values, handle) {
                    document.getElementById('altezza-value1').innerHTML = values[0];
                    document.getElementById('altezza-value2').innerHTML = values[1];
                    document.getElementById('altezza-min-value').value = moneyFormat.from(
                        values[0]
                    );
                    document.getElementById('altezza-max-value').value = moneyFormat.from(
                        values[1]
                    );
                
                });
                
                //   larghezza slider
                var larghezzaSlider = document.getElementById('larghezza');
                noUiSlider.create(larghezzaSlider, {
                    start: [$selected_final_largh_min, $selected_final_largh_max],
                    step: 1,
                    range: {
                        min: [$final_largh_min],
                        max: [$final_largh_max],
                    },
                    format: moneyFormat,
                    connect: true,
                });
                
                larghezzaSlider.noUiSlider.on('update', function (values, handle) {
                    document.getElementById('larghezza-value1').innerHTML = values[0];
                    document.getElementById('larghezza-value2').innerHTML = values[1];
                    document.getElementById('larghezza-min-value').value = moneyFormat.from(
                        values[0]
                    );
                    document.getElementById('larghezza-max-value').value = moneyFormat.from(
                        values[1]
                    );
                });
            // }
            //   ingombro altezza slider
            // if(is_ing === true){
                $final_ing_alt_min = parseInt($(".final_ing_alt_min").val());
                $final_ing_alt_max = parseInt($(".final_ing_alt_max").val());
                $final_ing_larg_min = parseInt($(".final_ing_larg_min").val());
                $final_ing_larg_max = parseInt($(".final_ing_larg_max").val());
                
                $selected_final_ing_alt_min = parseInt($(".final_ing_alt_min").attr('selected_value'));
                $selected_final_ing_alt_max = parseInt($(".final_ing_alt_max").attr('selected_value'));
                $selected_final_ing_larg_min = parseInt($(".final_ing_larg_min").attr('selected_value'));
                $selected_final_ing_larg_max = parseInt($(".final_ing_larg_max").attr('selected_value'));
                
                var ingaltezzaSlider = document.getElementById('ingaltezza');
                
                noUiSlider.create(ingaltezzaSlider, {
                    start: [$selected_final_ing_alt_min, $selected_final_ing_alt_max],
                    step: 1,
                    range: {
                        min: [$final_ing_alt_min],
                        max: [$final_ing_alt_max],
                    },
                    format: moneyFormat,
                    connect: true,
                });
                
                ingaltezzaSlider.noUiSlider.on('update', function (values, handle) {
                    
                    document.getElementById('ingaltezza-value1').innerHTML = values[0];
                    document.getElementById('ingaltezza-value2').innerHTML = values[1];
                    document.getElementById('ingaltezza-min-value').value = moneyFormat.from(
                        values[0]
                    );
                    document.getElementById('ingaltezza-max-value').value = moneyFormat.from(
                        values[1]
                    );
                });
                
                //   ingombro larghezza slider
                
                var inglarghezzaSlider = document.getElementById('inglarghezza');
                noUiSlider.create(inglarghezzaSlider, {
                    start: [$selected_final_ing_larg_min, $selected_final_ing_larg_max],
                    step: 1,
                    range: {
                        min: [$final_ing_larg_min],
                        max: [$final_ing_larg_max],
                    },
                    format: moneyFormat,
                    connect: true,
                });
                
                inglarghezzaSlider.noUiSlider.on('update', function (values, handle) {
                    document.getElementById('inglarghezza-value1').innerHTML = values[0];
                    document.getElementById('inglarghezza-value2').innerHTML = values[1];
                    document.getElementById('inglarghezza-min-value').value = moneyFormat.from(
                        values[0]
                    );
                    document.getElementById('inglarghezza-max-value').value = moneyFormat.from(
                        values[1]
                    );
                });
            // }

            const altezza = document.getElementById('altezza');
            altezza.noUiSlider.on('change', function (values, handle) {
                const slider_name = 'altezza';
                const term_filter_id = parseInt($("#luce_term_id").val());
                const min_max_val = values;
                check_slider_filter_items(min_max_val,term_filter_id,slider_name);
            });

            const larghezza = document.getElementById('larghezza');
            larghezza.noUiSlider.on('change', function (values, handle) {
                const slider_name = 'larghezza';
                const term_filter_id = parseInt($("#luce_term_id").val());
                if (insert_term_ids.indexOf(term_filter_id) === -1) {
                    insert_term_ids.push(term_filter_id);
                }
                const min_max_val = values;
                check_slider_filter_items(min_max_val,term_filter_id,slider_name);
            });

            const ingaltezza = document.getElementById('ingaltezza');
            ingaltezza.noUiSlider.on('change', function (values, handle) {
                const slider_name = 'ingaltezza';
                const term_filter_id = parseInt($("#ingo_term_id").val());
                if (insert_term_ids.indexOf(term_filter_id) === -1) {
                    insert_term_ids.push(term_filter_id);
                }
                const min_max_val = values;
                check_slider_filter_items(min_max_val,term_filter_id,slider_name);
            });


            const inglarghezza = document.getElementById('inglarghezza');
            inglarghezza.noUiSlider.on('change', function (values, handle) {
                const slider_name = 'inglarghezza';
                const term_filter_id = parseInt($("#ingo_term_id").val());
                if (insert_term_ids.indexOf(term_filter_id) === -1) {
                    insert_term_ids.push(term_filter_id);
                }
                const min_max_val = values;
                check_slider_filter_items(min_max_val,term_filter_id,slider_name);
            });
        }
    });

})(jQuery)