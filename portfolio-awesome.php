<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Portfolio_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Portfolio Builder Awesome
 * Plugin URI:        https://portfolio.themesawesome.com/
 * Description:       Create stunning portfolio without headache
 * Version:           1.1.0
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       portfolio-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PORTFOLIO_AWESOME_VERSION', '1.1.0' );

define( 'PORTFOLIO_AWESOME', __FILE__ );

define( 'PORTFOLIO_AWESOME_BASENAME', plugin_basename( PORTFOLIO_AWESOME ) );

define( 'PORTFOLIO_AWESOME_DIR', untrailingslashit( dirname( PORTFOLIO_AWESOME ) ) );

define( 'PORTFOLIO_AWESOME_NAME', plugin_basename( dirname( __FILE__ ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-portfolio-awesome-activator.php
 */
function activate_portfolio_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-awesome-activator.php';
	Portfolio_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-portfolio-awesome-deactivator.php
 */
function deactivate_portfolio_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-awesome-deactivator.php';
	Portfolio_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_portfolio_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_portfolio_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-awesome.php';

require plugin_dir_path( __FILE__ ) . 'portfolio-awesome-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';
require_once plugin_dir_path( __FILE__ ).'includes/aq_resizer.php';
require_once plugin_dir_path( __FILE__ ).'includes/custom-function.php';

require_once plugin_dir_path( __FILE__ ).'portfolio-awesome-templater.php';

function portfolio_awesome_new_elements(){
  require_once plugin_dir_path( __FILE__ ).'elementor-widgets/portfolios/portfolio-control.php';
}

add_action('elementor/widgets/widgets_registered','portfolio_awesome_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_portfolio_awesome() {

	$plugin = new Portfolio_Awesome();
	$plugin->run();

}
run_portfolio_awesome();

add_filter('manage_portfolio-awesome_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => esc_html__('Shortcode', 'portfolio-awesome')]);
});

add_action('manage_portfolio-awesome_posts_custom_column', function($column_key, $post_id) {
	echo wp_specialchars_decode( '<pre"><code>[portfolio_awesome id="'. esc_attr( $post_id ) .'"]</code></pre>' );
}, 10, 2);

add_filter( 'single_template', 'portfolio_awesome_post_custom_template', 50, 1 );
function portfolio_awesome_post_custom_template( $template ) {

	if ( is_singular( 'portfolio-awesome' ) ) {
		$template = PORTFOLIO_AWESOME_DIR . '/single-portfolio-awesome.php';
	}

	if ( is_singular( 'showcase-awesome' ) ) {
		$template = PORTFOLIO_AWESOME_DIR . '/single-showcase-awesome.php';
	}

	return $template;
}

add_action( 'after_setup_theme', 'portfolio_awesome_crb_load' );
function portfolio_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
	require_once plugin_dir_path( __FILE__ ) . 'gutenberg-portfolio.php';
}

add_action( 'elementor/preview/enqueue_styles', function() {

	wp_enqueue_style( 'ta-portfolio-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-portfolio-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-portfolio-awesome-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );

	wp_enqueue_script( 'ta-portfolio-awesome-swiper', plugin_dir_url( __FILE__ ) . 'public/js/swiper.min.js', array('jquery'), '', false );

	wp_enqueue_script( 'ta-portfolio-awesome-justifiedgallery', plugin_dir_url(__FILE__ ) . '/public/js/justifiedGallery.min.js', array('jquery', 'imagesloaded'), '', false );

	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
	}

	if(in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		wp_enqueue_style( 'agpb-advanced-masonry-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
	}

	if(in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		wp_enqueue_style( 'ajpb-advanced-justified-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-justified-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
	}

	if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

		wp_enqueue_script( 'ta-portfolio-awesome-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-portfolio-builder/assets/js/special1.js', array('jquery'), '', false );

		wp_enqueue_script( 'ta-portfolio-awesome-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-portfolio-builder/assets/js/special2.js', array('jquery'), '', false );

		wp_enqueue_script( 'ta-portfolio-awesome-swiper', plugin_dir_url( __DIR__ ) . 'advanced-carousel-portfolio-builder/assets/js/special3.js', array('jquery'), '', false );

		wp_enqueue_script( 'ta-portfolio-Charming-js', plugin_dir_url( __DIR__ ) . 'advanced-carousel-portfolio-builder/assets/js/charming.min.js', array('imagesloaded'), '', false );
		wp_enqueue_script( 'ta-portfolio-TweenMax', plugin_dir_url( __DIR__ ) . 'advanced-carousel-portfolio-builder/assets/js/TweenMax.min.js', array('imagesloaded'), '', true );
	}

	if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){

		wp_enqueue_style( 'aspb-advanced-slider-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

		wp_enqueue_script( 'ta-portfolio-TweenMax', plugin_dir_url( __DIR__ ) . 'advanced-slider-portfolio-builder/assets/js/TweenMax.min.js', array('imagesloaded'), '', true );

		wp_enqueue_script( 'ta-portfolio-anime', plugin_dir_url( __DIR__ ) . 'advanced-slider-portfolio-builder/assets/js/anime.min.js', array('imagesloaded'), '', true );

		wp_enqueue_script( 'aspb-advanced-slider-portfolio-builder-slider-1', plugin_dir_url( __DIR__ ) .'advanced-slider-portfolio-builder/assets/js/slider1.js', array('jquery','imagesloaded'), '', false );

		wp_enqueue_script( 'aspb-advanced-slider-portfolio-builder-slider-6', plugin_dir_url( __DIR__ ) .'advanced-slider-portfolio-builder/assets/js/slider6.js', array('jquery','imagesloaded'), '', false );
	}

} );


function portfolio_awesome( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'              =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'showcase-awesome', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-portfolio-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );

		wp_enqueue_style( 'ta-portfolio-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );

		wp_enqueue_style( 'ta-portfolio-awesome-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );

		wp_enqueue_style( 'ta-portfolio-awesome', plugin_dir_url(__FILE__ ) . 'public/css/portfolio-awesome-public.css', array(), '1.0.0', 'all' );

		if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'ampb-advanced-masonry-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'ajpb-advanced-justified-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-justified-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
		}

		if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		    wp_enqueue_style( 'aspb-advanced-slider-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
		}

		while ( $query->have_posts() ) {

			$query->the_post();

			$ta_ids = array();

			$portfolio_select_display_post = carbon_get_post_meta( get_the_ID(), 'portfolio_select_display_post' );
			$portfolio_awesome_showcase_posts = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_posts' );
			$portfolio_showcase_cats = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_cats' );
			$portfolio_showcase_order = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_order' );
			$portfolio_showcase_order_by = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_order_by' );

			// OPTION LAYOUT
			$portfolio_style_main = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style_main' );
			if($portfolio_style_main == 'grid') {
				$portfolio_style = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style' );
			}
			elseif($portfolio_style_main == 'masonry') {
				$portfolio_style = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style2' );
			}
			elseif($portfolio_style_main == 'carousel') {
				$portfolio_style = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style3' );
			}
			elseif($portfolio_style_main == 'justified') {
				$portfolio_style = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style4' );
			}
			elseif($portfolio_style_main == 'slider') {
				$portfolio_style = carbon_get_post_meta( get_the_ID(), 'portfolio_awesome_showcase_style5' );
			}

			$portfolio_awesome_post_hover = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_hover' );
			$portfolio_awesome_post_loading_grid = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_loading_grid' );
			$portfolio_awesome_post_per_page = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_items' );
			$portfolio_showcase_choose_grid = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_choose_grid' );

			$portfolio_showcase_choose_column = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_choose_column' );
			$portfolio_showcase_choose_column_tablet = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_choose_column_tablet' );
			$portfolio_showcase_choose_column_mobile = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_choose_column_mobile' );

    		$portfolio_column_carousel = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_choose_column_carousel' );

            $portfolio_use_arrow = carbon_get_post_meta( get_the_ID(), 'portfolio_use_arrow' );
            $portfolio_select_arrow = carbon_get_post_meta( get_the_ID(), 'portfolio_select_arrow' );
            $portfolio_select_dot = carbon_get_post_meta( get_the_ID(), 'portfolio_select_dot' );
            $portfolio_use_pagination = carbon_get_post_meta( get_the_ID(), 'portfolio_use_pagination' );

			$portfolio_use_arrow = carbon_get_post_meta( get_the_ID(), 'portfolio_use_arrow' );
			$portfolio_select_arrow = carbon_get_post_meta( get_the_ID(), 'portfolio_select_arrow' );
			$portfolio_select_dot = carbon_get_post_meta( get_the_ID(), 'portfolio_select_dot' );
			$portfolio_use_pagination = carbon_get_post_meta( get_the_ID(), 'portfolio_use_pagination' );

			// IMAGE SETTING

			$portfolio_width_image = carbon_get_post_meta( get_the_ID(), 'portfolio_width_image' );
			$portfolio_height_image = carbon_get_post_meta( get_the_ID(), 'portfolio_height_image' );
			$portfolio_use_crop = carbon_get_post_meta( get_the_ID(), 'portfolio_use_crop' );
            
            // LINK GOES TO
            $portfolio_link_post = carbon_get_post_meta( get_the_ID(), 'portfolio_select_link_post' );

			// PAGINATION & FILTER
			$portfolio_text_load_more = carbon_get_post_meta( get_the_ID(), 'portfolio_text_load_more' );
			$portfolio_pagination_type = carbon_get_post_meta( get_the_ID(), 'portfolio_pagination_type' );
			$use_filter = carbon_get_post_meta( get_the_ID(), 'portfolio_use_filter' );
			$portfolio_showcase_category_filter = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_category_filter' );
    		$button_text = carbon_get_post_meta( get_the_ID(), 'portfolio_button_content' );

			// SHOWCASE ID
			$showcase_id = get_the_ID();

			if(!empty($portfolio_showcase_choose_grid)) {
				$portfolio_showcase_choose_grid = $portfolio_showcase_choose_grid;
			} else {
				$portfolio_showcase_choose_grid = 3;
			}

			if(!empty($portfolio_awesome_post_per_page)) {
				$portfolio_awesome_post_per_page = $portfolio_awesome_post_per_page;
			} else {
				$portfolio_awesome_post_per_page = -1;
			}

			// ID PORTFOLIO
			if($portfolio_select_display_post == 'specific_post') {
				foreach ($portfolio_awesome_showcase_posts as $ta_posts) {
					$ta_ids[] = $ta_posts['id'];
				}
			}

			if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
			elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
			else { $paged = 1; }

			// WP_Query arguments

			// if by specific post
			if($portfolio_select_display_post == 'specific_post') {
				$port_args = array (
					'post__in' => $ta_ids,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
					'orderby'  => 'post__in',
					'post_type'       => 'portfolio-awesome', // YOUR POST TYPE
					'posts_per_page'       => $portfolio_awesome_post_per_page, // POSTS PER PAGE
					'paged'             => $paged, // PAGED
					'ignore_sticky_posts' => true,
				);
			} elseif ($portfolio_select_display_post == 'category') { //if by category
				$port_args = array (
					'post_status'     => 'publish',
					'post_type'       => 'portfolio-awesome', // YOUR POST TYPE
					'ignore_sticky_posts' => true,
					'paged'             => $paged, // PAGED
					'order' => $portfolio_showcase_order_by,
					'orderby' => $portfolio_showcase_order,
					'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-category',
							'field'    => 'slug',
							'terms'    => $portfolio_showcase_cats,
						),
					),
				);
			} else {
				$port_args = array (
					'post_status'     => 'publish',
					'post_type'       => 'portfolio-awesome', // YOUR POST TYPE
					'posts_per_page'       => $portfolio_awesome_post_per_page, // POSTS PER PAGE
					'ignore_sticky_posts' => true,
					'paged'             => $paged, // PAGED
					'orderby' => $portfolio_showcase_order,
					'order' => $portfolio_showcase_order_by
				);
			}

			// The Query
			$ta_portfo = new WP_Query( $port_args );

			// The Loop
			if ( $ta_portfo->have_posts() ) {

				if($portfolio_style == 'grid-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/grid-full-image-1.php';
				}
                elseif($portfolio_style == 'grid-card-1') {
                    $portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/grid-card-1.php';
                }
			    elseif($portfolio_style == 'grid-hiji') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-hiji.php';
			    }
			    elseif($portfolio_style == 'grid-dua') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-dua.php';
			    }
			    elseif($portfolio_style == 'grid-tilu') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-tilu.php';
			    }
			    elseif($portfolio_style == 'grid-opat') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-opat.php';
			    }
			    elseif($portfolio_style == 'grid-lima') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-lima.php';
			    }
			    elseif($portfolio_style == 'grid-genep') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-genep.php';
			    }
			    elseif($portfolio_style == 'grid-tujuh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-tujuh.php';
			    }
				elseif($portfolio_style == 'carousel-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/carousel-full-image-1.php';
				}
                elseif($portfolio_style == 'carousel-card-1') {
                    $portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/carousel-card-1.php';
                }
			    elseif($portfolio_style == 'carousel-hiji') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-hiji.php';
			    }
			    elseif($portfolio_style == 'carousel-dua') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-dua.php';
			    }
			    elseif($portfolio_style == 'carousel-tilu') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-tilu.php';
			    }
			    elseif($portfolio_style == 'carousel-opat') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-opat.php';
			    }
			    elseif($portfolio_style == 'carousel-lima') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-lima.php';
			    }
			    elseif($portfolio_style == 'carousel-genep') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-genep.php';
			    }
			    elseif($portfolio_style == 'carousel-tujuh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-tujuh.php';
			    }
			    elseif($portfolio_style == 'special-hiji-carousel') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-hiji.php';
			    }
			    elseif($portfolio_style == 'special-dua-carousel') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-dua.php';
			    }
			    elseif($portfolio_style == 'special-tilu-carousel') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-tilu.php';
			    }
			    elseif($portfolio_style == 'special-opat-carousel') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-opat.php';
			    }
				elseif($portfolio_style == 'carousel-3d-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/carousel-full-image-1.php';
				}
                elseif($portfolio_style == 'carousel-3d-card-1') {
                    $portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/carousel-card-1.php';
                }
				elseif($portfolio_style == 'masonry-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/masonry-full-image-1.php';
				}
                elseif($portfolio_style == 'masonry-card-1') {
                    $portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/masonry-card-1.php';
                }
			    elseif($portfolio_style == 'masonry-hiji') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-hiji.php';
			    }
			    elseif($portfolio_style == 'masonry-dua') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-dua.php';
			    }
			    elseif($portfolio_style == 'masonry-tilu') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-tilu.php';
			    }
			    elseif($portfolio_style == 'masonry-opat') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-opat.php';
			    }
			    elseif($portfolio_style == 'masonry-lima') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-lima.php';
			    }
			    elseif($portfolio_style == 'masonry-genep') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-genep.php';
			    }
			    elseif($portfolio_style == 'masonry-tujuh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-tujuh.php';
			    }
				elseif($portfolio_style == 'justified-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/justified-full-image-1.php';
				}
			    elseif($portfolio_style == 'justified-hiji') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-hiji.php';
			    }
			    elseif($portfolio_style == 'justified-dua') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-dua.php';
			    }
			    elseif($portfolio_style == 'justified-tilu') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-tilu.php';
			    }
			    elseif($portfolio_style == 'justified-opat') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-opat.php';
			    }
			    elseif($portfolio_style == 'justified-lima') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-lima.php';
			    }
			    elseif($portfolio_style == 'justified-genep') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-genep.php';
			    }
			    elseif($portfolio_style == 'justified-tujuh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-tujuh.php';
			    }
				elseif($portfolio_style == 'slider-full-image-1') {
					$portfolio_style_part = dirname( __FILE__ ) .'/public/portfolio-styles/slider-1.php';
				}
			    elseif($portfolio_style == 'slider-hiji') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-hiji.php';
			    }
			    elseif($portfolio_style == 'slider-dua') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-dua.php';
			    }
			    elseif($portfolio_style == 'slider-tilu') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-tilu.php';
			    }
			    elseif($portfolio_style == 'slider-opat') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-opat.php';
			    }
			    elseif($portfolio_style == 'slider-lima') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-lima.php';
			    }
			    elseif($portfolio_style == 'slider-genep') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-genep.php';
			    }
			    elseif($portfolio_style == 'slider-tujuh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-tujuh.php';
			    }
			    elseif($portfolio_style == 'slider-dalapan') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-dalapan.php';
			    }
			    elseif($portfolio_style == 'slider-salapan') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-salapan.php';
			    }
			    elseif($portfolio_style == 'slider-sapuluh') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-sapuluh.php';
			    }
			    elseif($portfolio_style == 'slider-sabelas') {
			        $portfolio_style_part = plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-sabelas.php';
			    }
			
				ob_start();
				include_once dirname( __FILE__ ) .'/public/partials/wrap-start.php';
				include_once $portfolio_style_part;
				include_once dirname( __FILE__ ) .'/public/partials/wrap-end.php';

				$content = ob_get_clean();
				return $content;

			} else {
				// no posts found
				return esc_html__( 'Sorry You have set no html for this slug...', 'portfolio-awesome' );

			}
		} 
	} 
	else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'portfolio-awesome' );

	}

// Restore original Post Data
	wp_reset_postdata();
	//return ob_get_clean();
}
add_shortcode( 'portfolio_awesome', 'portfolio_awesome' );

function portfolio_awesome_select_portfolio_post() {
	$portfolios_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'portfolio-awesome',
	);

	$portfolios = get_posts($args);

	foreach( $portfolios as $post ) { setup_postdata( $post );
		$portfolios_array[$post->ID] = $post->post_title;
	}

	return $portfolios_array;

	wp_reset_postdata();
}

function portfolio_awesome_select_showcase_post() {
	$showcases_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'showcase-awesome',
	);

	$showcases = get_posts($args);

	foreach( $showcases as $post ) { setup_postdata( $post );
		$showcases_array[$post->ID] = $post->post_title;
	}

	return $showcases_array;

	wp_reset_postdata();
}

add_action('wp_head', 'portfolio_awesome_color_custom_styles', 100);
function portfolio_awesome_color_custom_styles()
{
	$portfolio_awesome_custom_args = array(
	'post_type'         => 'showcase-awesome',
	'posts_per_page'    => -1,
	);
	$portfolio_awesome_custom = new WP_Query($portfolio_awesome_custom_args);
	if ($portfolio_awesome_custom->have_posts()) : ?>

   <style>
		<?php while($portfolio_awesome_custom->have_posts()) : $portfolio_awesome_custom->the_post();

		$portfolio_title_color = carbon_get_post_meta( get_the_ID(), 'portfolio_title_color' );
		$portfolio_fact_color = carbon_get_post_meta( get_the_ID(), 'portfolio_fact_color' );
		$portfolio_content_color = carbon_get_post_meta( get_the_ID(), 'portfolio_content_color' );
		$portfolio_number_color = carbon_get_post_meta( get_the_ID(), 'portfolio_number_color' );
		$portfolio_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_bg_color' );
		$portfolio_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_bg_hover_color' );
		$portfolio_button_text_color = carbon_get_post_meta( get_the_ID(), 'portfolio_button_text_color' );
		$portfolio_button_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_button_bg_color' );
		$portfolio_button_text_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_button_text_hover_color' );
		$portfolio_button_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_button_bg_hover_color' );
		$portfolio_frame_color = carbon_get_post_meta( get_the_ID(), 'portfolio_frame_color' );
		$portfolio_arrow_color_special = carbon_get_post_meta( get_the_ID(), 'portfolio_arrow_color_special' );


		$portfolio_showcase_padding = carbon_get_post_meta( get_the_ID(), 'portfolio_showcase_padding' );
		if($portfolio_showcase_padding != "" || $portfolio_showcase_padding === 0) {
			$portfolio_showcase_padding = $portfolio_showcase_padding;
		} else {
			$portfolio_showcase_padding = 30;
		}

		// Filter

		$portfolio_filter_color = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_color' );
		$portfolio_filter_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_hover_color' );
		$portfolio_filter_border_color = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_border_color' );
		$portfolio_filter_mobile_color = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_mobile_color' );
		$portfolio_filter_mobile_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_mobile_bg_color' );
		$portfolio_filter_align = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_align' );
		$portfolio_filter_margin_bottom = carbon_get_post_meta( get_the_ID(), 'portfolio_filter_margin_bottom' );

		if($portfolio_filter_margin_bottom != "" || $portfolio_filter_margin_bottom === 0) {
			$portfolio_filter_margin_bottom = $portfolio_filter_margin_bottom;
		} else {
			$portfolio_filter_margin_bottom = 0;
		}

		// Pagination Default

		$portfolio_pag_def_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_def_color' );
		$portfolio_pag_def_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_def_bg_color' );
		$portfolio_pag_def_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_def_hover_color' );
		$portfolio_pag_def_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_def_bg_hover_color' );
		$portfolio_pagination_align = carbon_get_post_meta( get_the_ID(), 'portfolio_pagination_align' );

		// Pagination Number

		$portfolio_pag_num_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_num_color' );
		$portfolio_pag_num_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_num_bg_color' );
		$portfolio_pag_num_current_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_num_current_color' );
		$portfolio_pag_num_bg_current_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_num_bg_current_color' );

		// Pagination Load More

		$portfolio_pag_load_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_load_color' );
		$portfolio_pag_load_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_load_bg_color' );
		$portfolio_pag_load_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_load_hover_color' );
		$portfolio_pag_load_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_pag_load_bg_hover_color' );

		// ARROW STYLE

		$portfolio_arrow_color = carbon_get_post_meta( get_the_ID(), 'portfolio_arrow_color' );
		$portfolio_arrow_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_arrow_hover_color' );
		$portfolio_arrow_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_arrow_bg_color' );
		$portfolio_arrow_bg_hover_color = carbon_get_post_meta( get_the_ID(), 'portfolio_arrow_bg_hover_color' );
		$portfolio_offside_arrow = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_arrow' );
		$portfolio_offside_arrow_tablet = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_arrow_tablet' );
		$portfolio_offside_arrow_mobile = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_arrow_mobile' );

		// DOT STYLE

		$portfolio_dot_border_color = carbon_get_post_meta( get_the_ID(), 'portfolio_dot_border_color' );
		$portfolio_dot_bg_color = carbon_get_post_meta( get_the_ID(), 'portfolio_dot_bg_color' );

		$portfolio_loading_bg = carbon_get_post_meta( get_the_ID(), 'portfolio_loading_bg' );
		$portfolio_offside_pagination = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_pagination' );
		$portfolio_offside_pagination_tablet = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_pagination_tablet' );
		$portfolio_offside_pagination_mobile = carbon_get_post_meta( get_the_ID(), 'portfolio_offside_pagination_mobile' );


		// HEIGHT ADJUST

		$portfolio_layout_height_option = carbon_get_post_meta( get_the_ID(), 'portfolio_layout_height_option' );
		$portfolio_header_height_custom = carbon_get_post_meta( get_the_ID(), 'portfolio_header_height_custom' );
		$portfolio_content_height_custom = carbon_get_post_meta( get_the_ID(), 'portfolio_content_height_custom' );
		$portfolio_overlay_color = carbon_get_post_meta( get_the_ID(), 'portfolio_overlay_color' );
		$portfolio_button_radius = carbon_get_post_meta( get_the_ID(), 'portfolio_button_radius' );

		?>

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-wrap {
			margin: 0 calc( -<?php echo esc_html($portfolio_showcase_padding); ?>px/2 );
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-wrap.swiper-wrapper {
			margin: 0;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-wrap.justify {
			margin: 0;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .portfolio-block-item .item-wrap,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid-template .portfolio-block-item.item-wrap {
			padding-right: calc( <?php echo esc_html($portfolio_showcase_padding); ?>px/2 );
			padding-left: calc( <?php echo esc_html($portfolio_showcase_padding); ?>px/2 );
			margin-bottom: <?php echo esc_html($portfolio_showcase_padding); ?>px;
		}

		<?php 

		//<!-- FILTER -->

		if(!empty($portfolio_filter_align)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> #portfolio-filter {
				text-align: <?php echo esc_html($portfolio_filter_align); ?>;
			}
		<?php } ?>


		<?php if(!empty($portfolio_filter_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li .filter-btn {
				color: <?php echo esc_html($portfolio_filter_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_filter_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li.activeFilter .filter-btn, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li:hover .filter-btn {
				color: <?php echo esc_html($portfolio_filter_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_filter_border_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li.activeFilter .filter-btn, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> ul.filters li:hover .filter-btn {
				border-color: <?php echo esc_html($portfolio_filter_border_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_filter_mobile_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> #filter-icon .bar {
				background: <?php echo esc_html($portfolio_filter_mobile_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_filter_mobile_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> #filter-icon {
				background: <?php echo esc_html($portfolio_filter_mobile_bg_color); ?>;
			}
		<?php } ?>

		<?php 

		//==============PAGINATION================ 

		if(!empty($portfolio_pagination_align)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging {
				text-align: <?php echo esc_html($portfolio_pagination_align); ?>;
			}
		<?php } 


		//=========PAGINATION DEFAULT============

		if(!empty($portfolio_pag_def_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a {
				color: <?php echo esc_html($portfolio_pag_def_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_def_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a {
				background-color: <?php echo esc_html($portfolio_pag_def_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_def_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a:hover {
				color: <?php echo esc_html($portfolio_pag_def_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_def_bg_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination .post-navigation a:hover {
				background-color: <?php echo esc_html($portfolio_pag_def_bg_hover_color); ?>;
			}
		<?php }


		//=========PAGINATION NUMBER============

		if(!empty($portfolio_pag_num_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn {
				color: <?php echo esc_html($portfolio_pag_num_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_num_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn {
				background-color: <?php echo esc_html($portfolio_pag_num_bg_color); ?>;
				border-color: <?php echo esc_html($portfolio_pag_num_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_num_current_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn.current,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn:hover {
				color: <?php echo esc_html($portfolio_pag_num_current_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_num_bg_current_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn.current,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.pagination-num .btn:hover {
				background-color: <?php echo esc_html($portfolio_pag_num_bg_current_color); ?>;
				border-color: <?php echo esc_html($portfolio_pag_num_bg_current_color); ?>;
			}
		<?php }


		//=========PAGINATION LOAD MORE============

		if(!empty($portfolio_pag_load_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button {
				color: <?php echo esc_html($portfolio_pag_load_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_load_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button {
				background-color: <?php echo esc_html($portfolio_pag_load_bg_color); ?>;
				border-color: <?php echo esc_html($portfolio_pag_load_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_load_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button:hover {
				color: <?php echo esc_html($portfolio_pag_load_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_pag_load_bg_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .navigation-paging.infinite-wrap button:hover {
				background-color: <?php echo esc_html($portfolio_pag_load_bg_hover_color); ?>;
				border-color: <?php echo esc_html($portfolio_pag_load_bg_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_title_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio__content h3 {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> figcaption h3 {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slide__title {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .grid__item--title {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			body .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider__text-inner {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			body .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider__text-inner--stroke {
				-webkit-text-stroke: 2px <?php echo esc_html($portfolio_title_color); ?>;
			    text-stroke: 2px <?php echo esc_html($portfolio_title_color); ?>;
			    -webkit-text-fill-color: transparent;
			    text-fill-color: transparent;
			    color: transparent;
			}

			@media screen and (min-width: 53em) {
				body .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .demo5 .slider__text-inner--stroke {
					-webkit-text-stroke: 3px <?php echo esc_html($portfolio_title_color); ?>;
    				text-stroke: 3px <?php echo esc_html($portfolio_title_color); ?>;
				}
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__title {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-sabelas .grid__item--name {
				color: <?php echo esc_html($portfolio_title_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_fact_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .fact-list li {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> figcaption span {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slide__side {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .caption {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-sabelas .grid__item--title {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_content_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-hiji .caption {
				color: <?php echo esc_html($portfolio_fact_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_content_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__desc {
				color: <?php echo esc_html($portfolio_content_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--text {
				color: <?php echo esc_html($portfolio_content_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_arrow_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop .icon-wrap::before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop .icon-wrap::after {
				background: <?php echo esc_html($portfolio_arrow_color); ?>;
				fill: <?php echo esc_html($portfolio_arrow_color); ?>;
				stroke: <?php echo esc_html($portfolio_arrow_color); ?>;
			}

			body .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid-wrap-item .icon {
				fill: <?php echo esc_html($portfolio_arrow_color); ?>;
			}
		<?php } ?>
		
		<?php if(!empty($portfolio_arrow_color_special)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .nav > i {
				color: <?php echo esc_html($portfolio_arrow_color_special); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_arrow_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond svg.icon,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide svg.icon {
				fill: <?php echo esc_html($portfolio_arrow_color); ?>;
				stroke: <?php echo esc_html($portfolio_arrow_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_offside_arrow)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
				left: <?php echo esc_html( $portfolio_offside_arrow ); ?>px;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
				right: <?php echo esc_html( $portfolio_offside_arrow ); ?>px;
			}
		<?php } ?>
		<?php if(!empty($portfolio_offside_arrow_tablet)) { ?>
			@media (max-width : 768px) {
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
					left: <?php echo esc_html( $portfolio_offside_arrow_tablet ); ?>px;
				}

				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
					right: <?php echo esc_html( $portfolio_offside_arrow_tablet ); ?>px;
				}
			}
		<?php } ?>
		<?php if(!empty($portfolio_offside_arrow_mobile)) { ?>
			@media (max-width : 575px) {
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.prev {
					left: <?php echo esc_html( $portfolio_offside_arrow_mobile ); ?>px;
				}

				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav a.next {
					right: <?php echo esc_html( $portfolio_offside_arrow_mobile ); ?>px;
				}
			}
		<?php } ?>

		<?php if($portfolio_offside_pagination != "" || $portfolio_offside_pagination === 0) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio ~ ul.swiper-pag,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
    			bottom: <?php echo esc_html( $portfolio_offside_pagination ); ?>px
			}
		<?php } ?>
		
		<?php if($portfolio_offside_pagination_tablet != "" || $portfolio_offside_pagination_tablet === 0) { ?>
			@media (max-width : 768px) {
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio ~ ul.swiper-pag,
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
	    			bottom: <?php echo esc_html( $portfolio_offside_pagination_tablet ); ?>px
				}
			}
		<?php } ?>
		
		<?php if($portfolio_offside_pagination_mobile != "" || $portfolio_offside_pagination_mobile === 0) { ?>
			@media (max-width : 575px) {
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio ~ ul.swiper-pag,
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider.has-pag ul.swiper-pag,
				.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .swiper-pag {
	    			bottom: <?php echo esc_html( $portfolio_offside_pagination_mobile ); ?>px
				}
			}
		<?php } ?>

		


		<?php if(!empty($portfolio_arrow_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a:hover .icon-wrap::before, .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a:hover .icon-wrap::after {
				background: <?php echo esc_html($portfolio_arrow_hover_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond a:hover svg.icon,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide a:hover svg.icon {
				fill: <?php echo esc_html($portfolio_arrow_hover_color); ?>;
				stroke: <?php echo esc_html($portfolio_arrow_hover_color); ?>;
			}

			body .portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav:hover .icon {
				fill: <?php echo esc_html($portfolio_arrow_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_arrow_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a::before,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond div,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide .icon-wrap {
				background: <?php echo esc_html($portfolio_arrow_bg_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav {
				background: <?php echo esc_html($portfolio_arrow_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_arrow_bg_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-circlepop a::before,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-fillslide .icon-wrap::before,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-nav.nav-diamond a:hover div {
				background: <?php echo esc_html($portfolio_arrow_bg_hover_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid__item--nav:hover {
				background: <?php echo esc_html($portfolio_arrow_bg_hover_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_dot_border_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-fillup.swiper-pag li a,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-circlegrow.swiper-pag li a {
				box-shadow: inset 0 0 0 2px <?php echo esc_html($portfolio_dot_border_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_dot_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-fillup.swiper-pag li a::after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-circlegrow.swiper-pag li a::after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::after {
				background: <?php echo esc_html($portfolio_dot_bg_color); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .dotstyle-flip.swiper-pag li a::before {
				opacity: 0.4;
			}
		<?php } ?>

		<?php if(!empty($portfolio_bg_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .special-dua .slideshow__deco {
				background-color: <?php echo esc_html( $portfolio_bg_color ); ?>;
			}

			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider__slide {
				background-color: <?php echo esc_html( $portfolio_bg_color ); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_bg_hover_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-reveal-']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-reveal-']:before,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-'] figcaption, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-'] figcaption,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks']:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter']:after, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz']:after, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert']:after, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel']:after, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds']:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds']:after, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-border-reveal'], 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-border-reveal'],
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-book-open-']:hover figcaption:before, 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-book-open-']:hover figcaption:after,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-stack-'], 
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-stack-'] {
				background-color: <?php echo esc_html($portfolio_bg_hover_color); ?>;
			}
		<?php } ?>

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blocks'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-blocks'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-shutter'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-shutter'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-horiz'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-horiz'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-strip-vert'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-strip-vert'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-pixel'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-pixel'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-blinds'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-blinds'] figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class^='imghvr-border-reveal'] figcaption, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> [class*=' imghvr-border-reveal'] figcaption {
			background-color: transparent;
		}

		<?php if(!empty($portfolio_button_text_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-item figcaption a,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a {
			color: <?php echo esc_html($portfolio_button_text_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link {
			color: <?php echo esc_html($portfolio_button_text_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item .inner-slider .button-view {
			color: <?php echo esc_html($portfolio_button_text_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($portfolio_button_bg_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-item figcaption a,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a {
			background-color: <?php echo esc_html($portfolio_button_bg_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link {
			background-color: <?php echo esc_html($portfolio_button_bg_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item .inner-slider .button-view {
			background-color: <?php echo esc_html($portfolio_button_bg_color); ?>;
			border-color: <?php echo esc_html($portfolio_button_bg_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($portfolio_button_text_hover_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-item figcaption a:hover,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a:hover {
			color: <?php echo esc_html($portfolio_button_text_hover_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link:hover {
			color: <?php echo esc_html($portfolio_button_text_hover_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item .inner-slider .button-view:hover {
			color: <?php echo esc_html($portfolio_button_text_hover_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($portfolio_button_bg_hover_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-block-item figcaption a:hover,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .justify-item figcaption a:hover {
			background-color: <?php echo esc_html($portfolio_button_bg_hover_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link:hover {
			background-color: <?php echo esc_html($portfolio_button_bg_hover_color); ?>;
		}

		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item .inner-slider .button-view:hover {
			background-color: <?php echo esc_html($portfolio_button_bg_hover_color); ?>;
			border-color: <?php echo esc_html($portfolio_button_bg_hover_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($portfolio_frame_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider path {
			fill: <?php echo esc_html($portfolio_frame_color); ?>;
		}
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .salapan.slideshow-slider path {
			fill: url(#pattern);
		}
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .salapan.slideshow-slider pattern {
			fill: <?php echo esc_html($portfolio_frame_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($portfolio_bg_hover_color)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-grid-unique .portfolio-block-item figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-carousel-unique .portfolio-block-item figcaption,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .portfolio-justified-unique .justify-item figcaption {
			background: <?php echo esc_html($portfolio_bg_hover_color); ?>;
		}
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?>.portfolio-grid-tujuh figcaption:after,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?>.portfolio-justified-tujuh figcaption:after,
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?>.portfolio-grid-tujuh .item-wrap2:hover figcaption:after, 
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?>.portfolio-grid-tujuh .item-wrap2.cs-hover figcaption:after {
			box-shadow: 0 0 0 10px <?php echo esc_html($portfolio_bg_hover_color); ?>;
		}
		<?php } ?>

		<?php if($portfolio_layout_height_option == 'fullscreen') {
			if(!empty($portfolio_header_height_custom)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-tilu .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-opat .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-lima .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item {
				height: calc(100vh - <?php echo esc_html( $portfolio_header_height_custom ); ?>px);
			}
			<?php }
		} elseif ($portfolio_layout_height_option == 'default') {
			if(!empty($portfolio_content_height_custom)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-tilu .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-opat .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-lima .slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-hiji .slider__img,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-dua .slider__img,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider,
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-portfolio .portfolio-block-item {
				height: <?php echo esc_html( $portfolio_content_height_custom ); ?>px;
			}
			<?php }
		} ?>

		<?php if(!empty($portfolio_overlay_color)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slider-overlay {
				background-color: <?php echo esc_html($portfolio_overlay_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($portfolio_button_radius)) { ?>
			.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .slideshow-slider .slide__link {
				border-radius: <?php echo esc_html($portfolio_button_radius); ?>px;
			}
		<?php } ?>


		
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .filter-wraper {
			margin-bottom: <?php echo esc_html($portfolio_filter_margin_bottom); ?>px;
		}

		<?php if(!empty($portfolio_loading_bg)) { ?>
		.portfolio-post-<?php echo esc_attr(get_the_ID()); ?> .grid__reveal {
			background-color: <?php echo esc_html($portfolio_loading_bg); ?>;
		}
		<?php } ?>
		<?php endwhile; wp_reset_postdata(); ?>
	</style>

	<?php endif;
}

add_filter('single_template', 'portfolio_awesome_single_portfolio');
function portfolio_awesome_single_portfolio($single) {
	global $post;

	// news
	if ( $post->post_type == 'portfolio-awesome' ) {
		if ( file_exists( PORTFOLIO_AWESOME_DIR . 'public/single-styles/single-portfolio-awesome-default.php' ) ) {
			return PORTFOLIO_AWESOME_DIR . 'public/single-styles/single-portfolio-awesome-default.php';
		}
	}

	return $single;
}

add_filter('wp_head', 'portfolio_awesome_single_color_custom_styles', 98);
function portfolio_awesome_single_color_custom_styles() {
	global $post;

	if ( $post->post_type == 'portfolio-awesome' && is_singular()) {

		$portfolio_awesome_single_header_height = carbon_get_theme_option( 'portfolio_awesome_single_header_height' );
		$portfolio_single_title_color = carbon_get_theme_option( 'portfolio_single_title_color' );
		$portfolio_single_title_active_color = carbon_get_theme_option( 'portfolio_single_title_active_color' );
		$portfolio_single_subtitle_color = carbon_get_theme_option( 'portfolio_single_subtitle_color' );
		$portfolio_single_subtitle_active_color = carbon_get_theme_option( 'portfolio_single_subtitle_active_color' );
		$portfolio_single_fact_color = carbon_get_theme_option( 'portfolio_single_fact_color' );
		$portfolio_single_bg_color = carbon_get_theme_option( 'portfolio_single_bg_color' );
		$portfolio_single_read_more_color = carbon_get_theme_option( 'portfolio_single_read_more_color' );
		$portfolio_single_arrow_color = carbon_get_theme_option( 'portfolio_single_arrow_color' );
		$portfolio_single_content_color = carbon_get_theme_option( 'portfolio_single_content_color' );

		$portfolio_awesome_single_padding_top = carbon_get_theme_option( 'portfolio_awesome_single_padding_top' );
		$portfolio_awesome_single_padding_bottom = carbon_get_theme_option( 'portfolio_awesome_single_padding_bottom' );
		$portfolio_awesome_single_width = carbon_get_theme_option( 'portfolio_awesome_single_width' ); ?>
		<style>
			<?php if(!empty($portfolio_awesome_single_header_height)) { ?>
			.single-portfolio-main-wrapper .header-single {
				height: calc(100vh - <?php echo intval($portfolio_awesome_single_header_height); ?>px);
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_title_color)) { ?>
			.single-portfolio-main-wrapper .header-single .title h1,
			.single-portfolio-main-wrapper.modify .header-single .title h1 {
				color: <?php echo esc_html( $portfolio_single_title_color ); ?>;
			}

			.single-portfolio-main-wrapper.intro-effect-sidefixed .title h1 {
				color: <?php echo esc_html( $portfolio_single_title_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_title_active_color)) { ?>
			.single-portfolio-main-wrapper .title h1,
			.single-portfolio-main-wrapper.intro-effect-sliced.modify .title h1,
			.single-portfolio-main-wrapper.intro-effect-fadeout.modify .title h1,
			.single-portfolio-main-wrapper.intro-effect-side.modify .title h1,
			.single-portfolio-main-wrapper.intro-effect-jam3.modify .title h1,
			.single-portfolio-main-wrapper.intro-effect-sidefixed.modify .content .title h1 {
				color: <?php echo esc_html( $portfolio_single_title_active_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_subtitle_color)) { ?>
			.single-portfolio-main-wrapper .header-single .title p.subline,
			.single-portfolio-main-wrapper.modify .header-single .title p.subline,
			.single-portfolio-main-wrapper .content .title p.subline {
				color: <?php echo esc_html( $portfolio_single_subtitle_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_subtitle_active_color)) { ?>
			.single-portfolio-main-wrapper .title p.subline,
			.single-portfolio-main-wrapper.intro-effect-fadeout.modify .title p.subline,
			.single-portfolio-main-wrapper.intro-effect-sliced.modify .title p.subline,
			.single-portfolio-main-wrapper.intro-effect-side.modify .title p.subline,
			.single-portfolio-main-wrapper.intro-effect-jam3.modify .title p.subline,
			.single-portfolio-main-wrapper.intro-effect-sidefixed.modify .content .title p.subline {
				color: <?php echo esc_html( $portfolio_single_subtitle_active_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_fact_color)) { ?>
			.single-portfolio-main-wrapper .title p,
			.single-portfolio-main-wrapper.intro-effect-fadeout .header-single .title p:nth-child(3),
			.single-portfolio-main-wrapper.intro-effect-side .header-single .title p:nth-child(3),
			.single-portfolio-main-wrapper .content .title p:nth-child(3),
			.single-portfolio-main-wrapper.intro-effect-jam3 .title p:nth-child(3),
			.single-portfolio-main-wrapper.intro-effect-sliced .header-single .title p:nth-child(3) {
				color: <?php echo esc_html( $portfolio_single_fact_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_read_more_color)) { ?>
			.single-portfolio-main-wrapper button.trigger::before {
				color: <?php echo esc_html( $portfolio_single_read_more_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_arrow_color)) { ?>
			.single-portfolio-main-wrapper button.trigger span::before {
				color: <?php echo esc_html( $portfolio_single_arrow_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_bg_color)) { ?>
			.single-portfolio-main-wrapper,
			.intro-effect-sidefixed .bg-img::after {
				background-color: <?php echo esc_html( $portfolio_single_bg_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_single_content_color)) { ?>
			.single-portfolio-main-wrapper .content,
			.single-portfolio-main-wrapper .content p {
				color: <?php echo esc_html( $portfolio_single_content_color ); ?>;
			}
			<?php } ?>
			<?php if(!empty($portfolio_awesome_single_padding_top)) { ?>
			.single-portfolio-main-wrapper .single-portfolio-wrap {
				padding-top: <?php echo esc_html( $portfolio_awesome_single_padding_top ); ?>px;
			}
			<?php } ?>
			<?php if(!empty($portfolio_awesome_single_padding_bottom)) { ?>
			.single-portfolio-main-wrapper .single-portfolio-wrap {
				padding-bottom: <?php echo esc_html( $portfolio_awesome_single_padding_bottom ); ?>px;
			}
			<?php } ?>

			
			.single-portfolio-main-wrapper.intro-effect-fadeout .single-portfolio-wrap {
				max-width: 900px;
			}

			.single-portfolio-main-wrapper.intro-effect-sliced .single-portfolio-wrap,
			.single-portfolio-main-wrapper.intro-effect-jam3 .single-portfolio-wrap {
				padding-top: 0px;
			}
		</style>

<?php }
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_pagination_option')) {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = portfolio_awesome_pagination_option();
				return $data_pagination;
			}
		} else {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = array(
					'' => 'No Pagination',
					'pagination_default' => 'Default',
					'pagination_number' => 'Number',
				);
				return $data_pagination;
			}
		}
	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_pagination_option_masonry')) {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = portfolio_awesome_pagination_option_masonry();
				return $data_pagination;
			}
		} else {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = array(
					'' => 'No Pagination',
					'pagination_default' => 'Default',
					'pagination_number' => 'Number',
				);
				return $data_pagination;
			}
		}
	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_pagination_option_justified')) {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = portfolio_awesome_pagination_option_justified();
				return $data_pagination;
			}
		} else {
			function portfolio_awesome_pagination_option_data() {
				$data_pagination = array(
					'' => 'No Pagination',
					'pagination_default' => 'Default',
					'pagination_number' => 'Number',
				);
				return $data_pagination;
			}
		}
	}
} else {
	function portfolio_awesome_pagination_option_data() {
		$data_pagination = array(
			'' => 'No Pagination',
			'pagination_default' => 'Default',
			'pagination_number' => 'Number',
		);
		return $data_pagination;
	}
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_loading_grid_option')) {
			function portfolio_awesome_loading_grid() {
				$data_hover_effect = portfolio_awesome_loading_grid_option();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_loading_grid() {
				$data_loading_grid = array(
					'' => 'Style 1',
				);
				return $data_loading_grid;
			}
		}
	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_loading_masonry_option_masonry')) {
			function portfolio_awesome_loading_grid() {
				$data_hover_effect = portfolio_awesome_loading_masonry_option_masonry();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_loading_grid() {
				$data_loading_grid = array(
					'' => 'Style 1',
				);
				return $data_loading_grid;
			}
		}
	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_loading_justified_option_justified')) {
			function portfolio_awesome_loading_grid() {
				$data_hover_effect = portfolio_awesome_loading_justified_option_justified();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_loading_grid() {
				$data_loading_grid = array(
					'' => 'Style 1',
				);
				return $data_loading_grid;
			}
		}
	}
} else {
	function portfolio_awesome_loading_grid() {
		$data_loading_grid = array(
			'' => 'Style 1',
		);
		return $data_loading_grid;
	}
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_hover_effect_option')) {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = portfolio_awesome_hover_effect_option();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = array(
					'' => 'Choice',
					'imghvr-zoom-in' => 'Zoom In',
					'imghvr-fade' => 'Fade',
					'imghvr-fade-in-up' => 'Fade In Up',
					'imghvr-fade-in-down' => 'Fade In Down',
					'imghvr-fade-in-left' => 'Fade In Left',
					'imghvr-fade-in-right' => 'Fade In Right',
					'imghvr-slide-up' => 'Slide Up',
					'imghvr-slide-down' => 'Slide Down',
					'imghvr-slide-left' => 'Slide Left',
					'imghvr-slide-right' => 'Slider Right',
					'imghvr-slide-top-left' => 'Slide Top Left',
					'imghvr-slide-top-right' => 'Slide Top Right',
					'imghvr-slide-bottom-left' => 'Slide Bottom Left',
					'imghvr-slide-bottom-right' => 'Slide Bottom Right',
					'imghvr-reveal-up' => 'Reveal Up',
					'imghvr-reveal-down' => 'Reveal Down',
					'imghvr-reveal-left' => 'Reveal Left',
					'imghvr-reveal-right' => 'Reveal Right',
					'imghvr-reveal-top-left' => 'Reveal Top-Left',
					'imghvr-reveal-top-right' => 'Reveal Top-Right',
					'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
					'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
				);
				return $data_hover_effect;
			}
		}
	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_hover_effect_option_masonry')) {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = portfolio_awesome_hover_effect_option_masonry();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = array(
					'' => 'Choice',
					'imghvr-zoom-in' => 'Zoom In',
					'imghvr-fade' => 'Fade',
					'imghvr-fade-in-up' => 'Fade In Up',
					'imghvr-fade-in-down' => 'Fade In Down',
					'imghvr-fade-in-left' => 'Fade In Left',
					'imghvr-fade-in-right' => 'Fade In Right',
					'imghvr-slide-up' => 'Slide Up',
					'imghvr-slide-down' => 'Slide Down',
					'imghvr-slide-left' => 'Slide Left',
					'imghvr-slide-right' => 'Slider Right',
					'imghvr-slide-top-left' => 'Slide Top Left',
					'imghvr-slide-top-right' => 'Slide Top Right',
					'imghvr-slide-bottom-left' => 'Slide Bottom Left',
					'imghvr-slide-bottom-right' => 'Slide Bottom Right',
					'imghvr-reveal-up' => 'Reveal Up',
					'imghvr-reveal-down' => 'Reveal Down',
					'imghvr-reveal-left' => 'Reveal Left',
					'imghvr-reveal-right' => 'Reveal Right',
					'imghvr-reveal-top-left' => 'Reveal Top-Left',
					'imghvr-reveal-top-right' => 'Reveal Top-Right',
					'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
					'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
				);
				return $data_hover_effect;
			}
		}
	} elseif (in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_hover_effect_option_carousel')) {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = portfolio_awesome_hover_effect_option_carousel();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = array(
					'' => 'Choice',
					'imghvr-zoom-in' => 'Zoom In',
					'imghvr-fade' => 'Fade',
					'imghvr-fade-in-up' => 'Fade In Up',
					'imghvr-fade-in-down' => 'Fade In Down',
					'imghvr-fade-in-left' => 'Fade In Left',
					'imghvr-fade-in-right' => 'Fade In Right',
					'imghvr-slide-up' => 'Slide Up',
					'imghvr-slide-down' => 'Slide Down',
					'imghvr-slide-left' => 'Slide Left',
					'imghvr-slide-right' => 'Slider Right',
					'imghvr-slide-top-left' => 'Slide Top Left',
					'imghvr-slide-top-right' => 'Slide Top Right',
					'imghvr-slide-bottom-left' => 'Slide Bottom Left',
					'imghvr-slide-bottom-right' => 'Slide Bottom Right',
					'imghvr-reveal-up' => 'Reveal Up',
					'imghvr-reveal-down' => 'Reveal Down',
					'imghvr-reveal-left' => 'Reveal Left',
					'imghvr-reveal-right' => 'Reveal Right',
					'imghvr-reveal-top-left' => 'Reveal Top-Left',
					'imghvr-reveal-top-right' => 'Reveal Top-Right',
					'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
					'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
				);
				return $data_hover_effect;
			}
		}
	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_hover_effect_option_justified')) {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = portfolio_awesome_hover_effect_option_justified();
				return $data_hover_effect;
			}
		} else {
			function portfolio_awesome_hover_effect() {
				$data_hover_effect = array(
					'' => 'Choice',
					'imghvr-zoom-in' => 'Zoom In',
					'imghvr-fade' => 'Fade',
					'imghvr-fade-in-up' => 'Fade In Up',
					'imghvr-fade-in-down' => 'Fade In Down',
					'imghvr-fade-in-left' => 'Fade In Left',
					'imghvr-fade-in-right' => 'Fade In Right',
					'imghvr-slide-up' => 'Slide Up',
					'imghvr-slide-down' => 'Slide Down',
					'imghvr-slide-left' => 'Slide Left',
					'imghvr-slide-right' => 'Slider Right',
					'imghvr-slide-top-left' => 'Slide Top Left',
					'imghvr-slide-top-right' => 'Slide Top Right',
					'imghvr-slide-bottom-left' => 'Slide Bottom Left',
					'imghvr-slide-bottom-right' => 'Slide Bottom Right',
					'imghvr-reveal-up' => 'Reveal Up',
					'imghvr-reveal-down' => 'Reveal Down',
					'imghvr-reveal-left' => 'Reveal Left',
					'imghvr-reveal-right' => 'Reveal Right',
					'imghvr-reveal-top-left' => 'Reveal Top-Left',
					'imghvr-reveal-top-right' => 'Reveal Top-Right',
					'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
					'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
				);
				return $data_hover_effect;
			}
		}
	}
} else {
	function portfolio_awesome_hover_effect() {
		$data_hover_effect = array(
			'' => 'Choice',
			'imghvr-zoom-in' => 'Zoom In',
			'imghvr-fade' => 'Fade',
			'imghvr-fade-in-up' => 'Fade In Up',
			'imghvr-fade-in-down' => 'Fade In Down',
			'imghvr-fade-in-left' => 'Fade In Left',
			'imghvr-fade-in-right' => 'Fade In Right',
			'imghvr-slide-up' => 'Slide Up',
			'imghvr-slide-down' => 'Slide Down',
			'imghvr-slide-left' => 'Slide Left',
			'imghvr-slide-right' => 'Slider Right',
			'imghvr-slide-top-left' => 'Slide Top Left',
			'imghvr-slide-top-right' => 'Slide Top Right',
			'imghvr-slide-bottom-left' => 'Slide Bottom Left',
			'imghvr-slide-bottom-right' => 'Slide Bottom Right',
			'imghvr-reveal-up' => 'Reveal Up',
			'imghvr-reveal-down' => 'Reveal Down',
			'imghvr-reveal-left' => 'Reveal Left',
			'imghvr-reveal-right' => 'Reveal Right',
			'imghvr-reveal-top-left' => 'Reveal Top-Left',
			'imghvr-reveal-top-right' => 'Reveal Top-Right',
			'imghvr-reveal-bottom-left' => 'Reveal Bottom-Left',
			'imghvr-reveal-bottom-right' => 'Reveal Bottom-Right',
		);
		return $data_hover_effect;
	}
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	function select_display_post_tapa() {
		$data_post_data = array(
			'' => esc_html__('All'),
			'category' => 'Category',
			'specific_post' => 'Specific Post',
		);
		return $data_post_data;
	}
} else {
	function select_display_post_tapa() {
		$data_post_data = array('' => '');
		return $data_post_data;
	}
	function select_display_post_by_js_script() {
		global $post; ?>
		<script type="text/javascript">
			jQuery(document).ready( function () { 
				function ta_pba_change_font_to_upper(str = '') {
					return str.replace(/(?:^|\s)\w/g, function(match) {
						return match.toUpperCase();
					});
				}

				var selectOptDef = jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]:checked').val();
				var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
				jQuery('[name="carbon_fields_compact_input[_portfolio_select_display_post]"]').empty().html(theOptDef);

				jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').on('change', function() {
					var selectOptCustom = jQuery(this).val();
						var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_portfolio_select_display_post]').ready(function() {
							jQuery('[name="carbon_fields_compact_input[_portfolio_select_display_post]"]').empty().html(theOptCustom);
						});
				})

			});
		</script>
	<?php }
	add_action('admin_head', 'select_display_post_by_js_script');
}

add_filter('redirect_canonical','ta_portfolio_awesome_redirect_canonical');
function ta_portfolio_awesome_redirect_canonical($redirect_url) {
	if (is_paged() && is_singular( 'showcase-awesome' )) $redirect_url = false;
	return $redirect_url;
}

function select_portfolio_awesome_order() {
	$portfolio_awesome_order = array(
		'ID'                    => 'ID',
		'title'                 => 'Title',
		'date'                  => 'Date',
		'rand'                  => 'Random'
	);

	return $portfolio_awesome_order;
}

function select_portfolio_awesome_order_by() {
	$portfolio_awesome_orderby = array(
		'asc'   => esc_html__('Ascending', 'portfolio-awesome'),
		'desc'     => esc_html__('Descending', 'portfolio-awesome'),
	);

	return $portfolio_awesome_orderby;
}


if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_filter_option')) {
			function select_use_filter_by_js() {
				$data_hover_effect = portfolio_awesome_filter_option();
				return $data_hover_effect;
			}
		} else {
			function select_use_filter_by_js() {
				$data_filter = array('' => '');
				return $data_filter;
			}
			function select_use_filter_by_js_script() {
				global $post; ?>
				<script type="text/javascript">
					jQuery(document).ready( function () { 
						function ta_pba_change_font_to_upper(str = '') {
							return str.replace(/(?:^|\s)\w/g, function(match) {
								return match.toUpperCase();
							});
						}

						var selectOptDef = jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]:checked').val();
						var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptDef);

						jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').on('change', function() {
							var selectOptCustom = jQuery(this).val();
								var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]').ready(function() {
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptCustom);
							})
						})

					});
				</script>
			<?php }
			add_action('admin_head', 'select_use_filter_by_js_script');
		}
	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_filter_option_masonry')) {
			function select_use_filter_by_js() {
				$data_hover_effect = portfolio_awesome_filter_option_masonry();
				return $data_hover_effect;
			}
		} else {
			function select_use_filter_by_js() {
				$data_filter = array('' => '');
				return $data_filter;
			}
			function select_use_filter_by_js_script() {
				global $post; ?>
				<script type="text/javascript">
					jQuery(document).ready( function () { 
						function ta_pba_change_font_to_upper(str = '') {
							return str.replace(/(?:^|\s)\w/g, function(match) {
								return match.toUpperCase();
							});
						}

						var selectOptDef = jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]:checked').val();
						var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptDef);

						jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').on('change', function() {
							var selectOptCustom = jQuery(this).val();
								var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]').ready(function() {
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptCustom);
							})
						})

					});
				</script>
			<?php }
			add_action('admin_head', 'select_use_filter_by_js_script');
		}
	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_filter_option_justified')) {
			function select_use_filter_by_js() {
				$data_hover_effect = portfolio_awesome_filter_option_justified();
				return $data_hover_effect;
			}
		} else {
			function select_use_filter_by_js() {
				$data_filter = array('' => '');
				return $data_filter;
			}
			function select_use_filter_by_js_script() {
				global $post; ?>
				<script type="text/javascript">
					jQuery(document).ready( function () { 
						function ta_pba_change_font_to_upper(str = '') {
							return str.replace(/(?:^|\s)\w/g, function(match) {
								return match.toUpperCase();
							});
						}

						var selectOptDef = jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]:checked').val();
						var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptDef);

						jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').on('change', function() {
							var selectOptCustom = jQuery(this).val();
								var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]').ready(function() {
								jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptCustom);
							})
						})

					});
				</script>
			<?php }
			add_action('admin_head', 'select_use_filter_by_js_script');
		}
	}
} else {
	function select_use_filter_by_js() {
		$data_filter = array('' => '');
		return $data_filter;
	}
	function select_use_filter_by_js_script() {
		global $post; ?>
		<script type="text/javascript">
			jQuery(document).ready( function () { 
				function ta_pba_change_font_to_upper(str = '') {
					return str.replace(/(?:^|\s)\w/g, function(match) {
						return match.toUpperCase();
					});
				}

				var selectOptDef = jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]:checked').val();
				var theOptDef = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptDef) + ' Add-On');
				jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptDef);

				jQuery('[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').on('change', function() {
					var selectOptCustom = jQuery(this).val();
						var theOptCustom = jQuery('<option></option>').attr("value", "").text('Need Advanced ' + ta_pba_change_font_to_upper(selectOptCustom) + ' Add-On');
						jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]').ready(function() {
						jQuery('[name="carbon_fields_compact_input[_portfolio_use_filter]"]').empty().html(theOptCustom);
					})
				})

			});
		</script>
	<?php }
	add_action('admin_head', 'select_use_filter_by_js_script');
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_style')) {
	    function portfolio_awesome_select_grid() {
	        $data_post_data = portfolio_awesome_style();
	        return $data_post_data;
	    }
	} else {
	    function portfolio_awesome_select_grid() {
	        $data_post_data = array(
	            'grid-full-image-1' => esc_html__('Grid Full Image', 'portfolio-awesome'),
	            'grid-card-1' => esc_html__('Grid Card', 'portfolio-awesome'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function portfolio_awesome_select_grid() {
        $data_post_data = array(
            'grid-full-image-1' => esc_html__('Grid Full Image', 'portfolio-awesome'),
            'grid-card-1' => esc_html__('Grid Card', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_style_masonry')) {
	    function portfolio_awesome_select_masonry() {
	        $data_post_data = portfolio_awesome_style_masonry();
	        return $data_post_data;
	    }
	} else {
	    function portfolio_awesome_select_masonry() {
	        $data_post_data = array(
	            'masonry-full-image-1' => esc_html__('Masonry Full Image', 'portfolio-awesome'),
	            'masonry-card-1' => esc_html__('Masonry Card', 'portfolio-awesome'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function portfolio_awesome_select_masonry() {
        $data_post_data = array(
            'masonry-full-image-1' => esc_html__('Masonry Full Image', 'portfolio-awesome'),
            'masonry-card-1' => esc_html__('Masonry Card', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_style_carousel')) {
	    function portfolio_awesome_select_carousel() {
	        $data_post_data = portfolio_awesome_style_carousel();
	        return $data_post_data;
	    }
	} else {
		function portfolio_awesome_select_carousel() {
	        $data_post_data = array(
	            'carousel-full-image-1' => esc_html__('Carousel Full Image', 'portfolio-awesome'),
	            'carousel-card-1' => esc_html__('Carousel Card', 'portfolio-awesome'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function portfolio_awesome_select_carousel() {
        $data_post_data = array(
            'carousel-full-image-1' => esc_html__('Carousel Full Image', 'portfolio-awesome'),
            'carousel-card-1' => esc_html__('Carousel Card', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_style_justified')) {
	    function portfolio_awesome_select_justified() {
	        $data_post_data = portfolio_awesome_style_justified();
	        return $data_post_data;
	    }
	} else {
		function portfolio_awesome_select_justified() {
	        $data_post_data = array(
	            'justified-full-image-1' => esc_html__('Justified Full Image', 'portfolio-awesome'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function portfolio_awesome_select_justified() {
        $data_post_data = array(
            'justified-full-image-1' => esc_html__('Justified Full Image', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_style_slider')) {
	    function portfolio_awesome_select_slider() {
	        $data_post_data = portfolio_awesome_style_slider();
	        return $data_post_data;
	    }
	} else {
		function portfolio_awesome_select_slider() {
	        $data_post_data = array(
	            'slider-full-image-1' => esc_html__('Slider Full Image', 'portfolio-awesome'),
	        );
	        return $data_post_data;
	    }
	}
} else {
    function portfolio_awesome_select_slider() {
        $data_post_data = array(
            'slider-full-image-1' => esc_html__('Slider Full Image', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
		if(function_exists('portfolio_awesome_link_option')) {
		    function portfolio_awesome_select_link_post() {
		        $data_post_data = portfolio_awesome_link_option();
		        return $data_post_data;
		    }
		} else {
			function portfolio_awesome_select_link_post() {
		        $data_post_data = array(
		            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
		            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
		        );
		        return $data_post_data;
		    }
		}
	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_link_option_masonry')) {
		    function portfolio_awesome_select_link_post() {
		        $data_post_data = portfolio_awesome_link_option_masonry();
		        return $data_post_data;
		    }
		} else {
			function portfolio_awesome_select_link_post() {
		        $data_post_data = array(
		            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
		            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
		        );
		        return $data_post_data;
		    }
		}
	} elseif (in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_link_option_carousel')) {
		    function portfolio_awesome_select_link_post() {
		        $data_post_data = portfolio_awesome_link_option_carousel();
		        return $data_post_data;
		    }
		} else {
			function portfolio_awesome_select_link_post() {
		        $data_post_data = array(
		            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
		            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
		        );
		        return $data_post_data;
		    }
		}
	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_link_option_justified')) {
		    function portfolio_awesome_select_link_post() {
		        $data_post_data = portfolio_awesome_link_option_justified();
		        return $data_post_data;
		    }
		} else {
			function portfolio_awesome_select_link_post() {
		        $data_post_data = array(
		            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
		            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
		        );
		        return $data_post_data;
		    }
		}
	} elseif (in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		if(function_exists('portfolio_awesome_link_option_slider')) {
		    function portfolio_awesome_select_link_post() {
		        $data_post_data = portfolio_awesome_link_option_slider();
		        return $data_post_data;
		    }
		} else {
			function portfolio_awesome_select_link_post() {
		        $data_post_data = array(
		            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
		            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
		        );
		        return $data_post_data;
		    }
		}
	}
} else {
    function portfolio_awesome_select_link_post() {
        $data_post_data = array(
            'portfolio_item' => esc_html__('Portfolio Item', 'portfolio-awesome'),
            'custom_link' => esc_html__('Custom Link', 'portfolio-awesome'),
        );
        return $data_post_data;
    }
}

if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_arrow_option_carousel')) {
		function portfolio_awesome_select_arrow_style() {
		    $data_post_data = portfolio_awesome_arrow_option_carousel();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_arrow_option_slider')) {
		function portfolio_awesome_select_arrow_style() {
		    $data_post_data = portfolio_awesome_arrow_option_slider();
		    return $data_post_data;
		}
	} else {
		function portfolio_awesome_select_arrow_style() {
		    $data_post_data = array(
		       'style-1' => 'Style 1',
		    );
		    return $data_post_data;
		}
	}
} else {
	function portfolio_awesome_select_arrow_style() {
	    $data_post_data = array(
	       'style-1' => 'Style 1',
	    );
	    return $data_post_data;
	}
}

if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
	if(function_exists('portfolio_awesome_pagination_option_carousel')) {
		function portfolio_awesome_select_pagination_style() {
		    $data_post_data = portfolio_awesome_pagination_option_carousel();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_pagination_option_slider')) {
		function portfolio_awesome_select_pagination_style() {
		    $data_post_data = portfolio_awesome_pagination_option_slider();
		    return $data_post_data;
		}
	} else {
		function portfolio_awesome_select_pagination_style() {
		    $data_post_data = array(
		       'style-1' => 'Style 1',
		    );
		    return $data_post_data;
		}
	}
} else {
	function portfolio_awesome_select_pagination_style() {
	    $data_post_data = array(
	       'style-1' => 'Style 1',
	    );
	    return $data_post_data;
	}
}

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if(function_exists('portfolio_awesome_single_option_grid')) {
		function portfolio_awesome_single_option() {
		    $data_post_data = portfolio_awesome_single_option_grid();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_single_option_justified')) {
		function portfolio_awesome_single_option() {
		    $data_post_data = portfolio_awesome_single_option_justified();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_single_option_masonry')) {
		function portfolio_awesome_single_option() {
		    $data_post_data = portfolio_awesome_single_option_masonry();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_single_option_carousel')) {
		function portfolio_awesome_single_option() {
		    $data_post_data = portfolio_awesome_single_option_carousel();
		    return $data_post_data;
		}
	} elseif(function_exists('portfolio_awesome_single_option_slider')) {
		function portfolio_awesome_single_option() {
		    $data_post_data = portfolio_awesome_single_option_slider();
		    return $data_post_data;
		}
	} else {
		function portfolio_awesome_single_option() {
		    $data_post_data = array(
		       'single-portfolio-awesome-blank.php' => esc_html__('Blank Template', 'portfolio-awesome'),
		    );
		    return $data_post_data;
		}
	}
} else {
	function portfolio_awesome_single_option() {
	    $data_post_data = array(
	       'single-portfolio-awesome-blank.php' => esc_html__('Blank Template', 'portfolio-awesome'),
	    );
	    return $data_post_data;
	}
}

add_action('init', 'portfolio_single_css', 97);
function portfolio_single_css() {
	$actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$post_id = url_to_postid($actual_url);
	$post_type = get_post_type( $post_id );
	if ($post_type == 'portfolio-awesome') {
		if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-styles', plugin_dir_url(__DIR__ ) . 'advanced-grid-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'ajpb-advanced-justified-portfolio-builder-styles', plugin_dir_url(__DIR__ ) . 'advanced-justified-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'ampb-advanced-masonry-portfolio-builder-styles', plugin_dir_url(__DIR__ ) . 'advanced-masonry-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-styles', plugin_dir_url(__DIR__ ) . 'advanced-carousel-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
     	} elseif (in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
     		wp_enqueue_style( 'acpb-advanced-slider-portfolio-builder-styles', plugin_dir_url(__DIR__ ) . 'advanced-slider-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
     	}
    }
}
