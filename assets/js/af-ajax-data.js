(function ($) {
    $(document).ready(function () {

        var url = action_url_ajax.ajax_url;
        $("body").delegate('.filter_news', 'click', function (e) {
            e.preventDefault();
            $(".home_filter").removeClass("active");
            $(this).addClass("active");
            get_post_filter_posts('news');
        });
        $("body").delegate('.filter_all', 'click', function (e) {
            e.preventDefault();
            $(".home_filter").removeClass("active");
            $(this).addClass("active");
            get_post_filter_posts('all');
        });
        $("body").delegate('.filter_event', 'click', function (e) {
            e.preventDefault();
            $(".home_filter").removeClass("active");
            $(this).addClass("active");
            get_post_filter_posts('events');
        });

        function get_post_filter_posts(category) {
            const spinner = `<div class="text-center" style="height:150px">
            <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>                            </div>`;
            $('#home_post_container').html(spinner);
            $.ajax({
                url: url,
                data: {
                    action: 'get_post_filter_posts',
                    category: category,
                },
                type: 'post',
                dataType: 'JSON',
                success: function (data) {
                    if (data.error == true) {
                        alert(data.message)
                    } else {
                        $('#home_post_container').html(data.data);
                    }
                }
            });
        }
        // end blog ajax processing 



        // start collection_feed_cat_pagi 
        $("body").delegate('.sec3_term_filter', 'mouseover', function (event) {
            const spinner = `<div class="text-center" style="height:150px">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                              </div>`;
            $('.display_term_img').html(spinner);
            var term_id = $(this).attr('term_id');
            $.ajax({
                url: url,
                data: {
                    action: 'collection_term_action',
                    term_id: term_id,
                },
                type: 'post',
                dataType: 'JSON',
                success: function (data) {
                    $(".display_term_img").html(data.data);
                },
            });
        });
        // end collection_feed_cat_pagi 
        $(window).on('load', function () {
            const term_id = $("a.sec3_term_filter.active").attr('term_id');
            $.ajax({
                url: url,
                data: {
                    action: 'collection_term_action',
                    term_id: term_id,
                },
                type: 'post',
                dataType: 'JSON',
                success: function (data) {
                    $(".display_term_img").html(data.data);
                },
            });
        });

        let get_mega_menu = $(".set_mega_menu").html();
        $(".prodotti-megamenu-parent").append(get_mega_menu);

        let set_csm_mega_menu = $(".set_csm_mega_menu").html();
        $(".chisiamo-megamenu-parent").append(set_csm_mega_menu);

        // $("body").delegate('.megamenu-main .megamenu-close', 'click', function (e) {
        //     e.preventDefault();
        //     $(this).closest('.megamenu-main').fadeOut('slow');
        // });


    });
})(jQuery)