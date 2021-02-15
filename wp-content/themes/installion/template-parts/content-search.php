<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maximized_Alpha
 */


		   $term = $_GET['search'];
echo do_shortcode('[ajax_load_more post_type="company" search="'. $term .'" scroll="true" ]');

?>