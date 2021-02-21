<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

if(!get_queried_object())
{
    return;
}
if(get_queried_object()->taxonomy=='product_cat')
{
    get_template_part('template-parts/template-category');

}elseif(get_queried_object()->post_name == 'shop')
    {
        get_template_part('template-parts/template-catalog');
    }

