<?php get_header();

global $wp;
if ( have_posts() ):

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
<div class="single-portfolio-wrap single-portfolio-showcase" style="max-width:<?php echo esc_attr($portfolio_awesome_single_width); ?>; padding-top: <?php echo esc_attr($portfolio_awesome_single_padding_top); ?>; padding-bottom: <?php echo esc_attr($portfolio_awesome_single_padding_bottom); ?>;">

<?php
wp_enqueue_style( 'ta-portfolio-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome-swiper', plugin_dir_url(__FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome-hover', plugin_dir_url(__FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );
wp_enqueue_style( 'ta-portfolio-awesome', plugin_dir_url(__FILE__ ) . 'public/css/portfolio-awesome-public.css', array(), '', 'all' );

if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
    wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-grid-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
}

if(in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
    wp_enqueue_style( 'ampb-advanced-masonry-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-masonry-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
}

if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
    wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-carousel-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
}

if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))){
    wp_enqueue_style( 'acpb-advanced-slider-portfolio-builder-styles', plugin_dir_url( __DIR__ ) . '/advanced-slider-portfolio-builder/assets/css/styles.css', array(), '', 'all' );
}

wp_enqueue_script( 'jquery');

wp_enqueue_script( 'masonry');
$showcase_id = get_the_ID();

while ( have_posts() ) : the_post();

	//global $post;

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
                'orderby'   => $portfolio_showcase_order,
                'order'   => $portfolio_showcase_order_by,
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
                'paged'             => $paged, // PAGED
                'posts_per_page'       => $portfolio_awesome_post_per_page, // POSTS PER PAGE
                'orderby'   => $portfolio_showcase_order,
                'order'   => $portfolio_showcase_order_by,
                'ignore_sticky_posts' => true,
            );
        }

        // The Query
        $ta_portfo = new WP_Query( $port_args );

        // The Loop
        if ( $ta_portfo->have_posts() ) :

		if($portfolio_style == 'grid-full-image-1') {
			include dirname( __FILE__ ) .'/public/portfolio-styles/grid-full-image-1.php';
		}
        elseif($portfolio_style == 'grid-card-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/grid-card-1.php';
        }
        elseif($portfolio_style == 'grid-hiji') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-hiji.php';
        }
        elseif($portfolio_style == 'grid-dua') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-dua.php';
        }
        elseif($portfolio_style == 'grid-tilu') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-tilu.php';
        }
        elseif($portfolio_style == 'grid-opat') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-opat.php';
        }
        elseif($portfolio_style == 'grid-lima') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-lima.php';
        }
        elseif($portfolio_style == 'grid-genep') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-genep.php';
        }
        elseif($portfolio_style == 'grid-tujuh') {
            include plugin_dir_path( __DIR__ ) .'advanced-grid-portfolio-builder/templates/grid-tujuh.php';
        }
		elseif($portfolio_style == 'masonry-full-image-1') {
			include dirname( __FILE__ ) .'/public/portfolio-styles/masonry-full-image-1.php';
		}
        elseif($portfolio_style == 'masonry-card-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/masonry-card-1.php';
        }
        elseif($portfolio_style == 'masonry-hiji') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-hiji.php';
        }
        elseif($portfolio_style == 'masonry-dua') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-dua.php';
        }
        elseif($portfolio_style == 'masonry-tilu') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-tilu.php';
        }
        elseif($portfolio_style == 'masonry-opat') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-opat.php';
        }
        elseif($portfolio_style == 'masonry-lima') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-lima.php';
        }
        elseif($portfolio_style == 'masonry-genep') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-genep.php';
        }
        elseif($portfolio_style == 'masonry-tujuh') {
            include plugin_dir_path( __DIR__ ) .'advanced-masonry-portfolio-builder/templates/masonry-tujuh.php';
        }
		elseif($portfolio_style == 'carousel-full-image-1') {
			include dirname( __FILE__ ) .'/public/portfolio-styles/carousel-full-image-1.php';
		}
        elseif($portfolio_style == 'carousel-card-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/carousel-card-1.php';
        }
        elseif($portfolio_style == 'carousel-hiji') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-hiji.php';
        }
        elseif($portfolio_style == 'carousel-dua') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-dua.php';
        }
        elseif($portfolio_style == 'carousel-tilu') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-tilu.php';
        }
        elseif($portfolio_style == 'carousel-opat') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-opat.php';
        }
        elseif($portfolio_style == 'carousel-lima') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-lima.php';
        }
        elseif($portfolio_style == 'carousel-genep') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-genep.php';
        }
        elseif($portfolio_style == 'carousel-tujuh') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/carousel-tujuh.php';
        }
        elseif($portfolio_style == 'special-hiji-carousel') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-hiji.php';
        }
        elseif($portfolio_style == 'special-dua-carousel') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-dua.php';
        }
        elseif($portfolio_style == 'special-tilu-carousel') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-tilu.php';
        }
        elseif($portfolio_style == 'special-opat-carousel') {
            include plugin_dir_path( __DIR__ ) .'advanced-carousel-portfolio-builder/templates/special-opat.php';
        }
        elseif($portfolio_style == 'carousel-3d-full-image-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/carousel-full-image-1.php';
        }
        elseif($portfolio_style == 'carousel-3d-card-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/carousel-card-1.php';
        }
        elseif($portfolio_style == 'justified-full-image-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/justified-full-image-1.php';
        }
        elseif($portfolio_style == 'justified-hiji') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-hiji.php';
        }
        elseif($portfolio_style == 'justified-dua') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-dua.php';
        }
        elseif($portfolio_style == 'justified-tilu') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-tilu.php';
        }
        elseif($portfolio_style == 'justified-opat') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-opat.php';
        }
        elseif($portfolio_style == 'justified-lima') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-lima.php';
        }
        elseif($portfolio_style == 'justified-genep') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-genep.php';
        }
        elseif($portfolio_style == 'justified-tujuh') {
            include plugin_dir_path( __DIR__ ) .'advanced-justified-portfolio-builder/templates/justified-tujuh.php';
        }
        elseif($portfolio_style == 'slider-full-image-1') {
            include dirname( __FILE__ ) .'/public/portfolio-styles/slider-1.php';
        }
        elseif($portfolio_style == 'slider-hiji') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-hiji.php';
        }
        elseif($portfolio_style == 'slider-dua') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-dua.php';
        }
        elseif($portfolio_style == 'slider-tilu') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-tilu.php';
        }
        elseif($portfolio_style == 'slider-opat') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-opat.php';
        }
        elseif($portfolio_style == 'slider-lima') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-lima.php';
        }
        elseif($portfolio_style == 'slider-genep') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-genep.php';
        }
        elseif($portfolio_style == 'slider-tujuh') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-tujuh.php';
        }
        elseif($portfolio_style == 'slider-dalapan') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-dalapan.php';
        }
        elseif($portfolio_style == 'slider-salapan') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-salapan.php';
        }
        elseif($portfolio_style == 'slider-sapuluh') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-sapuluh.php';
        }
        elseif($portfolio_style == 'slider-sabelas') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-sabelas.php';
        }
        elseif($portfolio_style == 'slider-duabelas') {
            include plugin_dir_path( __DIR__ ) .'advanced-slider-portfolio-builder/templates/slider-duabelas.php';
        }

	endif;

endwhile; ?>
</div>
<?php
endif;
wp_reset_postdata();
get_footer(); ?>