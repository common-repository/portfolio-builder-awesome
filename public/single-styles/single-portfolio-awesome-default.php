<?php 
/*
Template Name: Default Style
Template Post Type: portfolio-awesome
*/
 ?>

<?php 
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
<div class="single-portfolio-wrap single-portfolio-style-1 single-container" style="max-width:<?php echo esc_attr($portfolio_awesome_single_width); ?>; padding-top: <?php echo esc_attr($portfolio_awesome_single_padding_top); ?>; padding-bottom: <?php echo esc_attr($portfolio_awesome_single_padding_bottom); ?>;">
	<div class="row clearfix">
		<div class="portfolio-content-wrap column column-2of3">
			<div class="single-porfo-content">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="portfolio-detail column column-3">
			<div class="single-title-port">
				<h1><?php the_title(); ?></h1>
				<div class="category-portfolio">
					<?php $category_name = array();
					$category_slugs = array();
					$category_terms = wp_get_object_terms($post->ID, 'portfolio-category');
					if(!empty($category_terms)){
						if(!is_wp_error( $category_terms )){
						$category_slugs = array();
							foreach($category_terms as $term){
								$category_name[] = $term->name;
								$category_slugs[] = $term->slug;
							}

						$portfolio_porto_comas =  join( ", ", $category_name );
						$portfolio_porto_space =  join( " ", $category_slugs );

						}
					} else {
						$portfolio_porto_comas =  "";
						$portfolio_porto_space =  "";
					} ?>
					<span class="category"><?php echo esc_html($portfolio_porto_comas); ?></span>
				</div>
			</div>

			<div class="portfolio-content">
				<div class="portfolio-details">
					<ul class="list-facts">
						<?php portfolio_facts_single(get_the_ID()); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>