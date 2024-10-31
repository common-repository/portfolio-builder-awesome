<?php 
/*
Template Name: Single Portfolio Awesome
Template Post Type: portfolio-awesome
*/

get_header();

global $wp;
if ( have_posts() ):

wp_enqueue_style( 'ta-portfolio-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome', plugin_dir_url(__FILE__ ) . 'public/css/portfolio-awesome-public.css', array(), '1.0.0', 'all' );

while ( have_posts() ) : the_post();

	include_once dirname( __FILE__ ) .'/public/single-styles/single-portfolio-awesome-default.php';
   
endwhile; 
endif;
wp_reset_postdata();
get_footer(); ?>