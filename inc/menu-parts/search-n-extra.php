<?php



function search_n_extra()

{

    ob_start();

?>



    <li class="search_left_padding searchbox-parent">

        <a href="" class=""><i class="fa-regular fa-magnifying-glass"></i></a>

        <div class="custom-searchbox-main">

            <div class="card">

                <div class="card-header">

                    search box

                    <button class="search-close">

                        <i class="fa-light fa-xmark"></i>

                    </button>

                </div>

                <div class="card-body">

                    <form action="<?php echo home_url();?>" method="get">

                        <div class="form-group">

                            <input type="text" class="form-control" name="s" placeholder="Search ...">

                            <input type="submit" class="search-submit-btn" value="search">

                        </div>

                    </form>

                </div>

            </div>



        </div>

    </li>

    <li class="d-none">

        <a href=""><i class="fa-light fa-circle-user"></i></a>

    </li>

    <li>

        <a href="#">ITA</a>

        <ul class="sub-menu d-none">

            <li>

                <a href="#">ENG</a>

            </li>

        </ul>

    </li>

<?php

    return ob_get_clean();

}

add_shortcode('search_n_extra', 'search_n_extra');



?>