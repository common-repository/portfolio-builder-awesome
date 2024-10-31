<?php
// WP_Query arguments
    $args = array (
        'p'              => $portfolio_awesome_select_showcase_post,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
        'post_type'         => 'showcase-awesome', // YOUR POST TYPE

    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() && $portfolio_awesome_select_showcase_post != '' ) {

        wp_enqueue_style( 'ta-portfolio-awesome-fontawesome', plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );

        wp_enqueue_style( 'ta-portfolio-awesome-thaw-flexgrid', plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );

        wp_enqueue_style( 'ta-portfolio-awesome-swiper', plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/public/css/swiper.css', array(), '1.0.0', 'all' );

        wp_enqueue_style( 'ta-portfolio-awesome-hover', plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/public/css/hovers.css', array(), '1.0.0', 'all' );

        $advanced_grid_path = '';
        if(in_array('advanced-grid-portfolio-builder/advanced-grid-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_enqueue_style( 'agpb-advanced-grid-portfolio-builder-styles', plugin_dir_url('README.txt') .'/advanced-grid-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

            $advanced_grid_path = ADVANCED_GRID_PORTFOLIO_BUILDER_PATH;
        }

        $advanced_masonry_path = '';
        if(in_array('advanced-masonry-portfolio-builder/advanced-masonry-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_enqueue_style( 'ampb-advanced-masonry-portfolio-builder-styles', plugin_dir_url('README.txt') .'/advanced-masonry-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

            $advanced_masonry_path = ADVANCED_MASONRY_PORTFOLIO_BUILDER_PATH;
        }

        $advanced_carousel_path = '';
        if(in_array('advanced-carousel-portfolio-builder/advanced-carousel-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_enqueue_style( 'acpb-advanced-carousel-portfolio-builder-styles', plugin_dir_url('README.txt') .'/advanced-carousel-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

            $advanced_carousel_path = ADVANCED_CAROUSEL_PORTFOLIO_BUILDER_PATH;
        }

        $advanced_justified_path = '';
        if(in_array('advanced-justified-portfolio-builder/advanced-justified-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_enqueue_style( 'ajpb-advanced-justified-portfolio-builder-styles', plugin_dir_url('README.txt') .'/advanced-justified-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

            $advanced_justified_path = ADVANCED_JUSTIFIED_PORTFOLIO_BUILDER_PATH;
        }

        $advanced_slider_path = '';
        if(in_array('advanced-slider-portfolio-builder/advanced-slider-portfolio-builder.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            wp_enqueue_style( 'aspb-advanced-slider-portfolio-builder-styles', plugin_dir_url('README.txt') .'/advanced-slider-portfolio-builder/assets/css/styles.css', array(), '', 'all' );

            $advanced_slider_path = ADVANCED_SLIDER_PORTFOLIO_BUILDER_PATH;
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
                    'posts_per_page'       => $portfolio_awesome_post_per_page, // POSTS PER PAGE
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
                    'posts_per_page'       => $portfolio_awesome_post_per_page, // POSTS PER PAGE
                    'orderby'   => $portfolio_showcase_order,
                    'order'   => $portfolio_showcase_order_by,
                    'paged'             => $paged, // PAGED
                    'ignore_sticky_posts' => true,
                );
            }

            // The Query
            $ta_portfo = new WP_Query( $port_args );

            // The Loop
            if ( $ta_portfo->have_posts() ) :

                if($portfolio_style == 'grid-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/grid-full-image-1.php';
                }
                elseif($portfolio_style == 'grid-card-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/grid-card-1.php';
                }
                elseif($portfolio_style == 'grid-hiji') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-hiji.php';
                }
                elseif($portfolio_style == 'grid-dua') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-dua.php';
                }
                elseif($portfolio_style == 'grid-tilu') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-tilu.php';
                }
                elseif($portfolio_style == 'grid-opat') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-opat.php';
                }
                elseif($portfolio_style == 'grid-lima') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-lima.php';
                }
                elseif($portfolio_style == 'grid-genep') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-genep.php';
                }
                elseif($portfolio_style == 'grid-tujuh') {
                    $portfolio_style_part = $advanced_grid_path . 'templates/grid-tujuh.php';
                }
                elseif($portfolio_style == 'masonry-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/masonry-full-image-1.php';
                }
                elseif($portfolio_style == 'masonry-card-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/masonry-card-1.php';
                }
                elseif($portfolio_style == 'masonry-hiji') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-hiji.php';
                }
                elseif($portfolio_style == 'masonry-dua') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-dua.php';
                }
                elseif($portfolio_style == 'masonry-tilu') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-tilu.php';
                }
                elseif($portfolio_style == 'masonry-opat') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-opat.php';
                }
                elseif($portfolio_style == 'masonry-lima') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-lima.php';
                }
                elseif($portfolio_style == 'masonry-genep') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-genep.php';
                }
                elseif($portfolio_style == 'masonry-tujuh') {
                    $portfolio_style_part = $advanced_masonry_path . 'templates/masonry-tujuh.php';
                }
                elseif($portfolio_style == 'carousel-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/carousel-full-image-1.php';
                }
                elseif($portfolio_style == 'carousel-card-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/carousel-card-1.php';
                }
                elseif($portfolio_style == 'carousel-hiji') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-hiji.php';
                }
                elseif($portfolio_style == 'carousel-dua') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-dua.php';
                }
                elseif($portfolio_style == 'carousel-tilu') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-tilu.php';
                }
                elseif($portfolio_style == 'carousel-opat') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-opat.php';
                }
                elseif($portfolio_style == 'carousel-lima') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-lima.php';
                }
                elseif($portfolio_style == 'carousel-genep') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-genep.php';
                }
                elseif($portfolio_style == 'carousel-tujuh') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/carousel-tujuh.php';
                }
                elseif($portfolio_style == 'special-hiji-carousel') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/special-hiji.php';
                }
                elseif($portfolio_style == 'special-dua-carousel') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/special-dua.php';
                }
                elseif($portfolio_style == 'special-tilu-carousel') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/special-tilu.php';
                }
                elseif($portfolio_style == 'special-opat-carousel') {
                    $portfolio_style_part = $advanced_carousel_path . 'templates/special-opat.php';
                }
                elseif($portfolio_style == 'carousel-3d-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/carousel-full-image-1.php';
                }
                elseif($portfolio_style == 'carousel-3d-card-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/carousel-card-1.php';
                }
                elseif($portfolio_style == 'justified-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/justified-full-image-1.php';
                }
                elseif($portfolio_style == 'justified-hiji') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-hiji.php';
                }
                elseif($portfolio_style == 'justified-dua') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-dua.php';
                }
                elseif($portfolio_style == 'justified-tilu') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-tilu.php';
                }
                elseif($portfolio_style == 'justified-opat') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-opat.php';
                }
                elseif($portfolio_style == 'justified-lima') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-lima.php';
                }
                elseif($portfolio_style == 'justified-genep') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-genep.php';
                }
                elseif($portfolio_style == 'justified-tujuh') {
                    $portfolio_style_part = $advanced_justified_path . 'templates/justified-tujuh.php';
                }
                elseif($portfolio_style == 'slider-full-image-1') {
                    $portfolio_style_part = PORTFOLIO_AWESOME_DIR .'/public/portfolio-styles/slider-1.php';
                }
                elseif($portfolio_style == 'slider-hiji') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-hiji.php';
                }
                elseif($portfolio_style == 'slider-dua') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-dua.php';
                }
                elseif($portfolio_style == 'slider-tilu') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-tilu.php';
                }
                elseif($portfolio_style == 'slider-opat') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-opat.php';
                }
                elseif($portfolio_style == 'slider-lima') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-lima.php';
                }
                elseif($portfolio_style == 'slider-genep') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-genep.php';
                }
                elseif($portfolio_style == 'slider-tujuh') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-tujuh.php';
                }
                elseif($portfolio_style == 'slider-dalapan') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-dalapan.php';
                }
                elseif($portfolio_style == 'slider-salapan') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-salapan.php';
                }
                elseif($portfolio_style == 'slider-sapuluh') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-sapuluh.php';
                }
                elseif($portfolio_style == 'slider-sabelas') {
                    $portfolio_style_part = $advanced_slider_path . 'templates/slider-sabelas.php';
                }
                include $portfolio_style_part;

            endif;

        } wp_reset_postdata();
    } else {
        // no posts found
        return esc_html__( 'Sorry You have set no html for this slug...', 'portfolio-awesome' );

    }