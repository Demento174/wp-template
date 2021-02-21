<?php
namespace Controllers;

class CustomAdminFrontend
{
    public function __construct()
    {
        add_action('login_head', [$this,'custom_login_page']);

        add_action('login_head', [$this,'my_custom_login_logo']);

        add_action('add_admin_bar_menus', [$this,'reset_admin_wplogo']);

        add_action( 'login_header', [$this,'wpse330527_add_html_content'] );

    }


    function custom_login_page() {

        echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/public/css/admin.css" />';
    }

    function my_custom_login_logo(){

        echo '<style type="text/css">
	
	h1 a { background-image:url('.get_field('common','options')['faveicon']['url'].') !important; }
	
	</style>';
    }

    function reset_admin_wplogo(  ){

        remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 ); // удаляем стандартную панель (логотип)

        add_action( 'admin_bar_menu', 'my_admin_bar_wp_menu', 10 ); // добавляем свою
    }

    function my_admin_bar_wp_menu( $wp_admin_bar ) {

        $wp_admin_bar->add_menu( array(

            'id'    => 'wp-logo',

            'title' => '<img style="width:30px;height:30px;" src="'. get_field('common','options')['faveicon']['url'].'" alt="" >', // иконка dashicon

            'href'  => home_url('/'),

            'meta'  => array(

                'title' => 'О моем сайте',
            ),
        ) );
    }

    function wpse330527_add_html_content() {
        ?>
        <div class="video_wrapper">
            <video preload="auto" autoplay="autoplay" loop="loop" muted="true" poster="" class="video_background">
                <source src="<?=get_template_directory_uri()?>/public/video/GENERAL-ELEVATOR-GE-promotional-video_3-1.mp4" type="video/mp4">
            </video>
        </div>


        <?php
    }

}