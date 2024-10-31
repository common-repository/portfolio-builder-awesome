<div class="portfolio-content portfolio-post-<?php echo esc_attr($showcase_id); ?> main-container porto-card-style<?php if ($portfolio_link_post == 'lightbox') { ?> lightbox-parent<?php } ?>">
	<?php 
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if($portfolio_select_display_post == "category") {
			$portfolio_showcase_cats = $portfolio_showcase_cats;
		} elseif($portfolio_select_display_post == "specific_post") {
			$portfolio_showcase_cats = $portfolio_showcase_category_filter;
		}
		ta_agpb_filter_grid_temp($use_filter, $portfolio_showcase_cats, $portfolio_select_display_post);
	} ?>

	<div class="portfolio-block-wrap grid-template clearfix">
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
			$image_portores =  aq_resize($img_url_porto[0],  $portfolio_width_image , $portfolio_height_image, true, true, true);
			$image_gallery = $img_url_porto[0];
		} else {
			$image_portores = '';
			$image_gallery = '';
		}

		global $post;
		$category_name = array();
		$category_terms = get_the_terms($post->ID, 'portfolio-category');
		if(!empty($category_terms)){
			if(!is_wp_error( $category_terms )){
			$category_slugs = array();
				foreach($category_terms as $term){
					$category_name[] = $term->name;
					$category_slugs[] = $term->slug;
				}
		$porto_comas =  join( ", ", $category_name );
		$porto_space =  join( " ", $category_slugs );
			}
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
		}

		?>
		<div class="portfolio-block-item column-<?php echo esc_attr($portfolio_showcase_choose_column); ?> mobile-column-<?php echo esc_attr($portfolio_showcase_choose_column_mobile); ?> tablet-column-<?php echo esc_attr($portfolio_showcase_choose_column_tablet); ?> <?php echo sanitize_text_field($porto_space); ?>"<?php if ($portfolio_link_post == 'lightbox') { ?> data-src="<?php echo esc_attr($link_post); ?>"<?php } ?>>
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

	<?php
	endwhile; wp_reset_postdata(); ?>
	</div>

	<!-- PAGINATION START -->
	<?php
	$pages = '';
	$range = 2;
	$showitems = ($range * 2)+1;
	if($pages == '')
	{
		$pages = $ta_portfo->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}
	if($portfolio_pagination_type == 'pagination_number') {
		if(1 != $pages)
		{

			echo "<div class='navigation-paging pagination-num clearfix'>";
				echo "<div class='container'>";
					if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='" . esc_url( get_pagenum_link(1) ) . "'>". esc_html__( 'First', 'portfolio-awesome' ) ."</a>";
					if($paged > 1 && $showitems < $pages) echo "<a href='" . esc_url( get_pagenum_link($paged - 1) ) . "'>&lsaquo;</a>";

					for ($i=1; $i <= $pages; $i++)
					{
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
						{
							echo ($paged == $i)? "<span class='btn current'>" . esc_html($i) . "</span>":"<a href='" . esc_url( get_pagenum_link($i) ) ."' class='btn inactive' >" . esc_html($i) . "</a>";
						}
					}

					if ($paged < $pages && $showitems < $pages) echo "<a href='" . esc_url( get_pagenum_link($paged + 1) ) . "'>&rsaquo;</a>";
					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='" . esc_url( get_pagenum_link( $pages ) ) . "'>". esc_html__( 'Last', 'portfolio-awesome' ) ."</a>";
				echo "</div>\n";
			echo "</div>\n";

		}
	}
	elseif($portfolio_pagination_type == 'pagination_default') {
		if(1 != $pages) { ?>
		<nav class="navigation-paging pagination pagination-page-template clearfix">
			<div class="container">
				<div class="post-navigation nav-previous pull-left">
					<?php echo next_posts_link( 'Next', $ta_portfo->max_num_pages ); ?>
				</div>
				<?php if ( get_previous_posts_link() ) : ?>
				<div class="post-navigation nav-next pull-right">
					<?php echo get_previous_posts_link( esc_html__( 'Prev', 'portfolio-awesome' ) ); ?>
				</div>
				<?php endif; ?>
			</div>
		</nav>
	<?php }
	}
	elseif ($portfolio_pagination_type == 'portfolio_pagination_none') {} ?>

	<?php 
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if($portfolio_pagination_type == 'pagination_load_more') {
		if (!empty($portfolio_text_load_more)) {
			$portfolio_text_load_more = esc_html($portfolio_text_load_more);
		} else {
			$portfolio_text_load_more = esc_html__('Load More', 'portfolio-awesome');
		} ?>
		<div class="container clearfix">
			<div class="navigation-paging infinite-wrap clearfix">
				<div id="load-more-loop-grid-1" class="infinite-button">
					<?php next_posts_link( '', $ta_portfo->max_num_pages ); ?>
				</div>
				<button id="load-infinite-loop-grid11" class="btn"><?php echo esc_html( $portfolio_text_load_more ); ?></button>
			</div>
		</div>
		<?php } ?>

		<?php if($portfolio_pagination_type == 'pagination_infinite') { ?>
		<div class="display-none">
			<div id="load-more-loop-grid-1" class="infinite-button">
				<?php next_posts_link( '', $ta_portfo->max_num_pages ); ?>
			</div>
			<button id="load-infinite-loop-grid11" class="btn"><?php echo esc_html__( 'Load More', 'portfolio-awesome' ); ?></button>
		</div>
		<?php }
	} ?>

</div>

<?php
if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	wp_enqueue_script( 'agpb-advanced-grid-portfolio-builder-isotope', ADVANCED_GRID_PORTFOLIO_BUILDER_URL . 'assets/js/isotope.min.js', array('jquery', 'imagesloaded'), '', false );
	wp_enqueue_script( 'agpb-advanced-grid-portfolio-builder-infinite-scroll',  ADVANCED_GRID_PORTFOLIO_BUILDER_URL . 'assets/js/infinite-scroll.min.js', array('masonry'), '', false );

	if ($portfolio_link_post == 'lightbox') {
		wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-light-gallery', ADVANCED_GRID_PORTFOLIO_BUILDER_URL . 'assets/css/lightgallery.css', array(), '', 'all' );
		wp_enqueue_script( 'agpb-advanced-grid-portfolio-builder-light-gallery',  ADVANCED_GRID_PORTFOLIO_BUILDER_URL . 'assets/js/lightgallery.js', array('jquery'), '', false );
	}
}
else {
	wp_enqueue_script( array('jquery', 'masonry', 'imagesloaded'), '', true );
}

wp_enqueue_script( 'ta-portfolio-awesome-anime', plugin_dir_url(__DIR__ ) . 'js/anime.min.js', array('jquery'), '', false );

wp_enqueue_script( 'ta-portfolio-awesome-effect-grid', plugin_dir_url(__DIR__ ) . 'js/effect-grid.js', array('jquery'), '', false ); ?>

<?php 
if(class_exists('Elementor\Plugin')) {
	if (\Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
	<script>
	(function($) {

		'use strict';

		$(document).ready(function(){
			var $grid = $('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template').imagesLoaded().progress( function() {
				// init Masonry after all images have loaded
				$grid.masonry({
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.portfolio-block-item',
					itemSelector: '.portfolio-block-item',
					stagger: 30,
					layoutMode: 'fitRows',
				});
			});
		});

	})( jQuery );
	</script>
	<?php }
	else { ?>
	<script>
	(function($) {

		'use strict';

		$('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template').addClass('grid--loading');

		var body = document.querySelectorAll('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template'),
			grids = [].slice.call(document.querySelectorAll('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template')), masonry = [],
			currentGrid = 0,
			// The GridLoaderFx instances.
			loaders = [],
			loadingTimeout = setTimeout (500);


		function init() {
			// Preload images

			imagesLoaded('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template', function() {
				// Initialize Masonry on each grid.

				var m = new Masonry('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template', {
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.portfolio-block-item',
					itemSelector: '.portfolio-block-item',
					stagger: 0,
					layoutMode: 'fitRows',

				});

				loaders.push(new GridLoaderFx(grids[currentGrid]));

				loaders[currentGrid]._render("<?php if(!empty($portfolio_awesome_post_loading_grid)) { echo esc_html( $portfolio_awesome_post_loading_grid ); } else { echo esc_html( 'Hapi' ); } ?>");

				// Show current grid.
				grids[currentGrid].classList.remove('grid--loading');
			});
		}

		$(window).on('load', function () {
			init();
		});

	})( jQuery );
	</script>
		
	<?php if ($portfolio_link_post == 'lightbox') { ?>
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
	<?php } ?>

	<?php 
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		ta_agpb_filter_grid_script($showcase_id, $use_filter, $portfolio_pagination_type);
	} ?>
	<?php }
} else { ?>
	<script>
	(function($) {

		'use strict';

		$('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template').addClass('grid--loading');

		var body = document.querySelectorAll('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template'),
			grids = [].slice.call(document.querySelectorAll('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template')), masonry = [],
			currentGrid = 0,
			// The GridLoaderFx instances.
			loaders = [],
			loadingTimeout = setTimeout (500);


		function init() {
			// Preload images

			imagesLoaded('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template', function() {
				// Initialize Masonry on each grid.

				var m = new Masonry('.portfolio-post-<?php echo esc_attr($showcase_id); ?> .grid-template', {
					transitionDuration: '0.65s',
					initLayout: true,
					columnWidth: '.portfolio-block-item',
					itemSelector: '.portfolio-block-item',
					stagger: 0,
					layoutMode: 'fitRows',

				});

				loaders.push(new GridLoaderFx(grids[currentGrid]));

				loaders[currentGrid]._render("<?php if(!empty($portfolio_awesome_post_loading_grid)) { echo esc_html( $portfolio_awesome_post_loading_grid ); } else { echo esc_html( 'Hapi' ); } ?>");

				// Show current grid.
				grids[currentGrid].classList.remove('grid--loading');
			});
		}

		$(window).on('load', function () {
			init();
		});

	})( jQuery );
	</script>
		
	<?php if ($portfolio_link_post == 'lightbox') { ?>
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
	<?php } ?>

	<?php 
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		ta_agpb_filter_grid_script($showcase_id, $use_filter, $portfolio_pagination_type);
	} ?>
<?php }
