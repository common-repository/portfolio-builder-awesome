<div class="portfolio-post-<?php echo esc_attr($showcase_id); ?> port-main-wrapper">
	<div class="portfolio-post-<?php echo esc_attr($showcase_id); ?> swiper-container<?php if($portfolio_use_pagination == true) { ?> has-pagination<?php } ?><?php if ($portfolio_link_post == 'lightbox') { ?> lightbox-parent<?php } ?><?php if($portfolio_column_carousel == 'auto') { ?> porto-width-auto<?php } ?>">
		<div class="portfolio-content main-container swiper-wrapper porto-card-style">

			<?php

			while ( $ta_portfo->have_posts() ) : $ta_portfo->the_post();

			if(!empty($portfolio_width_image)) {
	            $portfolio_width_image = $portfolio_width_image;
	        } else {
	            $portfolio_width_image = 400;
	        }

	        if(!empty($portfolio_height_image)) {
	            $portfolio_height_image = $portfolio_height_image;
	        } else {
	            $portfolio_height_image = 400;
	        }

	        if(!empty($portfolio_use_crop)) {
	            $portfolio_use_crop = $portfolio_use_crop;
	        } else {
	            $portfolio_use_crop = false;
	        }

			if (has_post_thumbnail()) {
				$img_url_porto = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				
				if($portfolio_column_carousel == 'auto') {
					$image_portores =  aq_resize($img_url_porto[0],  9999 , $portfolio_height_image, false, true, true);
				} else {
					$image_portores =  aq_resize($img_url_porto[0],  $portfolio_width_image , $portfolio_height_image, true, true, true);
				}
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

			<div class="portfolio-block-item swiper-slide"<?php if ($portfolio_link_post == 'lightbox') { ?> data-src="<?php echo esc_attr($link_post); ?>"<?php } ?>>
				<div class="item-wrap">
					<figure class="<?php if(!empty($portfolio_awesome_post_hover)) { echo esc_attr($portfolio_awesome_post_hover); } else { ?>imghvr-reveal-down<?php } ?>">
						<img src="<?php echo esc_url($image_portores) ?>" alt="">
						<figcaption>
							<div class="caption-inside">
								<div class="portfolio__content">
									<a <?php if ($portfolio_link_post == 'lightbox') { ?>href="" class="lightbox-image" title="<?php the_title(); ?>" data-src="<?php echo esc_attr($link_post); ?>"<?php } else { ?> href="<?php echo esc_url($link_post); ?>"<?php } ?>><i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</figcaption>
					</figure>
					<div class="portfolio__content">
						<h3>
							<?php the_title(); ?>
						</h3>
						<ul class="fact-list">
						<?php portfolio_facts_showcase_grid_image(get_the_ID()); ?>
						</ul>
					</div>
				</div>
			</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>

	</div>

	<?php 
	if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		acpb_ta_pagination_carousel_temp($portfolio_use_pagination, $portfolio_select_dot);
		acpb_ta_arrow_carousel_temp($portfolio_use_arrow, $portfolio_select_arrow);
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

	portfolio_style_script($showcase_id, $portfolio_style);

	if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if ($portfolio_link_post == 'lightbox') {
			wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-light-gallery', ADVANCED_CAROUSEL_PORTFOLIO_BUILDER_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
			wp_enqueue_script( 'acpb-advanced-carousel-portfolio-builder-light-gallery',  ADVANCED_CAROUSEL_PORTFOLIO_BUILDER_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
		}
	}
?>

<?php 
if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
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