<?php
use Controllers\Blocks\Blocks\Breadcrumbs;
use Controllers\Blocks\Blocks\SearchField;

return
    [
        'dirname'=>'Views',
        'functions'=>
            [
                'get_field'=>'get_field',
                'wp_head'=>'wp_head',
                'wp_footer'=>'wp_footer',
                'get_permalink'=>'get_permalink',
                'public_dir'=>function(){return get_template_directory_uri().'/public/';},
                'current_url'=>function(){return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";},

                /**
                 * Woocommerce
                 */
                'item_in_the_cart'=>function(){return \Controllers\WC\WCController::item_in_the_cart();},

                /**
                 * Blocks
                 */
                'menu_header'=>function(){
                    wp_nav_menu( ['menu'  => 'header','container'=>false,'menu_class'=>'navigation flex_row justify_around align_center']);
                    } ,

                'block_breadcrumbs'=>function()
                {
                    $breadcrumbs = new Breadcrumbs(get_queried_object());
                    $breadcrumbs->render();
                },
                'block_search_form'=>function()
                {
                    $search_form = new SearchField();
                    $search_form->render();
                },
                ],

    ];