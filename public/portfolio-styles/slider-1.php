<div class="portfolio-post-<?php echo esc_attr($showcase_id); ?> port-main-wrapper">
	<div class="portfolio-post-<?php echo esc_attr($showcase_id); ?> slider-portfolio swiper-container<?php if($portfolio_use_pagination == true) { ?> has-pagination<?php } ?><?php if($portfolio_column_carousel == 'auto') { ?> porto-width-auto<?php } ?><?php if ($portfolio_link_post == 'lightbox') { ?> lightbox-parent<?php } ?>">
		<div class="portfolio-block-wrap swiper-wrapper porto-full-image-style">

			<?php

			while ( $ta_portfo->have_posts() ) : $ta_portfo->the_post();

			if (has_post_thumbnail()) {
				$img_url_porto = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$image_portores =  aq_resize($img_url_porto[0],  1600 , 1600, true, true, true);
				$image_gallery = $img_url_porto[0];
			} else {
				$image_portores = '';
				$image_gallery = '';
			}

			$custom_link = carbon_get_post_meta( get_the_ID(), 'portfolio_custom_link' );

			if($portfolio_link_post == 'portfolio_item') {
				$link_post = get_permalink();
			} elseif ($portfolio_link_post == 'lightbox') {
				$link_post = $image_gallery;
			} elseif ($portfolio_link_post == 'lightbox_portfolio_item') {
				$link_post = "#";
			} else {
				if(!empty($custom_link)) {
					$link_post = $custom_link;
				} else {
					$link_post = get_permalink();
				}
			} ?>
			<div class="portfolio-block-item swiper-slide"<?php if ($portfolio_link_post == 'lightbox') { ?> data-src="<?php echo esc_attr($link_post); ?>"<?php } ?> style="background-image: url(<?php echo esc_attr( $image_portores ); ?>);">
				<div class="slider-background-overlay"></div>
				<div class="inner-slider animated fadeInRight">
					<h1><?php the_title(); ?></h1>
					<p><?php echo portfolio_excerpt(15); ?></p>
					<a <?php if ($portfolio_link_post == 'lightbox') { ?>href="" class="lightbox-image button-view" title="<?php the_title(); ?>" data-src="<?php echo esc_attr( $link_post ); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>" class="button-view"<?php } ?>>
						<?php 
						if(!empty($button_text)) {
							echo esc_html($button_text);
						} else {
							echo esc_html__('View', 'portfolio-awesome');
						} ?>
					</a>
				</div>
				<div class="slider-overlay"></div>
			</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>

	</div>


	<?php 
	if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		aspb_ta_pagination_slider_temp($portfolio_use_pagination, $portfolio_select_dot);
		aspb_ta_arrow_slider_temp($portfolio_use_arrow, $portfolio_select_arrow);
	} else { ?>
		<?php if($portfolio_use_pagination == true) { ?>
			<ul class="swiper-pag dotstyle-fillup"></ul>
		<?php } ?>

		<?php if($portfolio_use_arrow == true) { ?>
			<div class="swiper-nav nav-circlepop">
				<a class="prev" href="#">
					<span class="icon-wrap"></span>
				</a>
				<a class="next" href="#">
					<span class="icon-wrap"></span>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
</div>

<?php
wp_enqueue_script( 'ta-portfolio-awesome-swiper', plugin_dir_url(__DIR__ ) . 'js/swiper.min.js', array('jquery', 'imagesloaded'), '', false );

portfolio_slider_script($showcase_id, $portfolio_style);

if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if ($portfolio_link_post == 'lightbox') {
			wp_enqueue_style( 'acpb-advanced-slider-portfolio-builder-light-gallery', ADVANCED_SLIDER_PORTFOLIO_BUILDER_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
			wp_enqueue_script( 'acpb-advanced-slider-portfolio-builder-light-gallery',  ADVANCED_SLIDER_PORTFOLIO_BUILDER_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
		}
	}

if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if ($portfolio_link_post == 'lightbox') { ?>
		<script>
			(function($) {

				'use strict';
				$(document).on('ready', function () {
					if ($('.lightbox-parent').length) {
				        $('.lightbox-parent').lightGallery({
				            thumbnail: false,
				            download: false,
				            selector: '.lightbox-image'
				        });
				    }
				});

			})( jQuery );
		</script>
<?php }
}