<?php


/**
 * Template functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Template
 * @since 1.0
 */
if((float) phpversion()<7.4)
{
    $current_version = phpversion();
    wp_die("min version php 7.4, current version $current_version");
}

require_once (get_template_directory().'/autoload.php');

new Controllers\TemplateSetup\TemplateSetup();

new Controllers\TwigSettings\TwigSettings();

new Controllers\ACF\ACFController();

new Controllers\ScriptsAndStyles\RegisterScriptsAndStyle();

new Controllers\DisableContentEditor\DisableContentEditorController();

new Controllers\SimpleAJAX\IndexSimpleAjax();

new Controllers\DisableAdminMenu\DisableAdminMenuController();

//new Controllers\CPT\CustomPostTypeController();

//new Controllers\CPT\CustomTaxonomyController();

//new \Controllers\CustomAdminFrontend();

//\Controllers\PostsAndTax\TaxonomyAbstract::preserving_hierarchy();


function renderBlock($block,$options=[],$id=null,$debug=false)
{
    $class = new \Controllers\Blocks\BlockController($block,$options,$id,$debug);
    return $class->render();
}

function add_metabox_acf_repeater($selectorACF,$posts,$titleBox,$group=null)
{

    new Controllers\MetaBox\Fields\ACFRepeater($selectorACF,$posts,$titleBox,$group);
}

function get_metabox_acf_repeater($selector,$group=null,$id=null)
{
    global $post;
    return Controllers\MetaBox\Fields\ACFRepeater::get_field(!$id?$post->ID:$id,['selector'=>$selector,'group'=>$group]);
}






//add_metabox_acf_repeater('brands',['product'],'Бренды','options');

