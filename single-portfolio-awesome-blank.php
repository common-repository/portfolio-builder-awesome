<?php 
/*
Template Name: Single Portfolio Awesome Blank
Template Post Type: portfolio-awesome
*/

get_header();

global $wp;
if ( have_posts() ):
while ( have_posts() ) : the_post();

$portfolio_client = carbon_get_post_meta( get_the_ID(), 'portfolio_client_name' );
$portfolio_date = carbon_get_post_meta( get_the_ID(), 'portfolio_date' );

$portfolio_awesome_single_width = carbon_get_theme_option( 'portfolio_awesome_single_width' );
$portfolio_awesome_single_padding_top = carbon_get_theme_option( 'portfolio_awesome_single_padding_top' );
$portfolio_awesome_single_padding_bottom = carbon_get_theme_option( 'portfolio_awesome_single_padding_bottom' );

if(!empty($portfolio_awesome_single_width) && $portfolio_awesome_single_width != '0') {
	$portfolio_awesome_single_width = $portfolio_awesome_single_width .'px';
} else { 
	$portfolio_awesome_single_width = '1080px'; 
}

if(!empty($portfolio_awesome_single_padding_top) && $portfolio_awesome_single_padding_top != '0') {
	$portfolio_awesome_single_padding_top = $portfolio_awesome_single_padding_top .'px';
} else { 
	$portfolio_awesome_single_padding_top = '0'; 
}

if(!empty($portfolio_awesome_single_padding_bottom) && $portfolio_awesome_single_padding_bottom != '0') {
	$portfolio_awesome_single_padding_bottom = $portfolio_awesome_single_padding_bottom .'px';
} else { 
	$portfolio_awesome_single_padding_bottom = '0'; 
} ?>
	<div class="single-portfolio-wrap single-portfolio-blank" style="max-width:<?php echo esc_attr($portfolio_awesome_single_width); ?>; padding-top: <?php echo esc_attr($portfolio_awesome_single_padding_top); ?>; padding-bottom: <?php echo esc_attr($portfolio_awesome_single_padding_bottom); ?>;">
		<?php the_content(); ?>
	</div>
<?php
endwhile; 
endif;
wp_reset_postdata(); ?>
<?php get_footer(); ?>