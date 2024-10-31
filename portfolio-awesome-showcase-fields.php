<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make( 'post_meta', 'side_shortcode', esc_html__( 'Shortcode', 'portfolio-awesome' ) )
	->where( 'post_type', '=', 'showcase-awesome' )
	->set_context( 'side' )
	->set_priority( 'default' )
	->add_fields( array(

	Field::make( 'html', 'portfolio_style', esc_html__( 'Section Description', 'portfolio-awesome' ) )
		->set_html( sprintf( '<div class="shortcode-wrap-ta"><code id="shortcode_portfolio_to_copy"></code></div>', __( 'Here, you can add some useful description for the fields below / above this text.' ) ) ),
));

Container::make( 'post_meta', 'portfolio_showcase_features', esc_html('Portfolio Showcase') )
->where( 'post_type', '=', 'showcase-awesome' )
->set_priority( 'default' )
->add_tab(  esc_html__( 'Layout', 'portfolio-awesome' ), array( // Layout Tab

    Field::make( 'radio_image', 'portfolio_awesome_showcase_style_main', esc_html__( 'Select Layout', 'portfolio-awesome' ) )
    ->set_classes( 'select-image-layout' )
    ->set_width( 50 )
    ->add_options( array(
        'grid' => plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/assets/grid.png',
        'masonry' => plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/assets/masonry.png',
        'carousel' => plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/assets/carousel.png',
        'justified' => plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/assets/justified.png',
        'slider' => plugin_dir_url('README.txt') . PORTFOLIO_AWESOME_NAME . '/assets/slide.png',
    )),

    Field::make( 'select', 'portfolio_awesome_showcase_style', esc_html__( 'Select Style', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->add_options( 
        portfolio_awesome_select_grid()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_awesome_showcase_style2', esc_html__( 'Select Style', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->add_options( 
        portfolio_awesome_select_masonry()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_awesome_showcase_style3', esc_html__( 'Select Style', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->add_options( 
        portfolio_awesome_select_carousel()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_awesome_showcase_style4', esc_html__( 'Select Style', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->add_options( 
        portfolio_awesome_select_justified()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_awesome_showcase_style5', esc_html__( 'Select Style', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->add_options( 
        portfolio_awesome_select_slider()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_showcase_choose_grid', esc_html__( 'Choose Column', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-hiji',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '12' => '1',
       '6' => '2',
       '4' => '3',
       '3' => '4',
    )),

    Field::make( 'separator', 'portfolio_separator_col_title1', 'Column' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column', esc_html__( 'Choose Column', 'portfolio-awesome' ) )
    ->set_width( 33 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style1',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style1',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       '5' => '5',
       '6' => '6',
       '7' => '7',
       '8' => '8',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column_carousel', esc_html__( 'Choose Column', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '2' => '2',
       '3' => '3',
       '4' => '4',
       '5' => '5',
       '6' => '6',
       '7' => '7',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_row_carousel', esc_html__( 'Choose Row', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column_tablet', esc_html__( 'Choose Column Tablet', 'portfolio-awesome' ) )
    ->set_width( 33 )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column_tablet_carousel', esc_html__( 'Choose Column Tablet', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_row_tablet_carousel', esc_html__( 'Choose Row Tablet', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column_mobile', esc_html__( 'Choose Column Mobile', 'portfolio-awesome' ) )
    ->set_width( 33 )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_column_mobile_carousel', esc_html__( 'Choose Column Mobile', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
       'auto' => 'Auto',
    )),

    Field::make( 'select', 'portfolio_showcase_choose_row_mobile_carousel', esc_html__( 'Choose Row Mobile', 'portfolio-awesome' ) )
    ->set_width( 16 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options( array(
       '1' => '1',
       '2' => '2',
       '3' => '3',
       '4' => '4',
    )),

    Field::make( 'separator', 'portfolio_separator_col_title2', 'Space & Size' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    )),

    Field::make( 'number', 'portfolio_showcase_padding', esc_html__( 'Padding', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ))
    ->set_width( 33 ),

    Field::make( 'number', 'portfolio_width_image', esc_html__( 'Width', 'portfolio-awesome' ) )
    ->set_conditional_logic( 
        array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-hiji',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 33 ),

    Field::make( 'number', 'portfolio_height_image', esc_html__( 'Height', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'justified-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-hiji',
            'compare' => '=',
        ),
    ) )
    ->set_width( 33 ),

    Field::make( 'separator', 'portfolio_separator_col_title3', 'Animation & Filter' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
    )),

    Field::make( 'separator', 'portfolio_separator_col_title_animation', 'Animation' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_showcase_hover', esc_html__( 'Hover Style', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'masonry-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options(
        portfolio_awesome_hover_effect()
    ),

    Field::make( 'select', 'portfolio_showcase_loading_grid', __( 'Loading Style' ) )
    ->set_width( 25)
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'justified-full-image-1',
            'compare' => '=',
        ),
    ))
    ->add_options(
        portfolio_awesome_loading_grid()
    ),

    Field::make( 'select', 'portfolio_use_filter', esc_html__( 'Use Filter', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'justified-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
       select_use_filter_by_js()
    ),

    Field::make( 'select', 'portfolio_pagination_type', esc_html__( 'Pagination', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style2',
            'value' => 'masonry-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'grid-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'justified-full-image-1',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        portfolio_awesome_pagination_option_data()
    ),

    Field::make( 'checkbox', 'portfolio_use_crop', esc_html__( 'Crop Image', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-hiji',
            'compare' => '=',
        ),
    ) )
    ->set_width( 33 )
    ->set_option_value( 'yes' ),

    Field::make( 'separator', 'portfolio_separator_col_title4', 'Carousel Options' )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    )),

    Field::make( 'separator', 'portfolio_separator_col_title_slider', 'Slider Options' )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'select', 'portfolio_layout_height_option', esc_html__( 'Slider Layout Height', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        array(
            '' => esc_html__('Choose', 'portfolio-awesome'),
            'default' => esc_html__('Default', 'portfolio-awesome'),
            'fullscreen' => esc_html__('Full Screen', 'portfolio-awesome')
        )
    ),

    Field::make( 'number', 'portfolio_header_height_custom', esc_html__( 'Header Height', 'team-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( 
    array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_layout_height_option',
            'value' => 'fullscreen',
            'compare' => '=',
        ),
    )),

    Field::make( 'number', 'portfolio_content_height_custom', esc_html__( 'Content Height', 'team-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( 
    array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_layout_height_option',
            'value' => 'default',
            'compare' => '=',
        ),
    )),

    Field::make( 'checkbox', 'portfolio_use_arrow', esc_html__( 'Use Arrow Navigation', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'portfolio_use_pagination', esc_html__( 'Use Pagination', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'portfolio_use_autoplay', esc_html__( 'Use Autoplay', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-dalapan',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'portfolio_centered_slides', esc_html__( 'Centered Slides', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'portfolio_use_loop', esc_html__( 'Loop Mode', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ),
    array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'carousel-card-1',
            'compare' => '=',
        ),
    ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' ),

    Field::make( 'checkbox', 'portfolio_scroll_mouse', esc_html__( 'Scroll Slide', 'portfolio-awesome' ) )
    ->set_width( 15 )
    ->set_option_value( 'yes' )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_select_arrow', esc_html__( 'Select Arrow Style', 'portfolio-awesome' ) )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        portfolio_awesome_select_arrow_style()
    ),

    Field::make( 'select', 'portfolio_select_dot', esc_html__( 'Select Dot Style', 'portfolio-awesome' ) )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) )
    ->add_options( 
        portfolio_awesome_select_pagination_style()
    ),

    Field::make( 'text', 'portfolio_autoplay_speed', esc_html__( 'Autoplay Speed (in Millisecond)', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '2500' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_autoplay',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_arrow', esc_html__( 'Arrow Offside', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_arrow_tablet', esc_html__( 'Arrow Offside Tablet', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_arrow_mobile', esc_html__( 'Arrow Offside Mobile', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_pagination', esc_html__( 'Pagination Offside', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_pagination_tablet', esc_html__( 'Pagination Offside Tablet', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'text', 'portfolio_offside_pagination_mobile', esc_html__( 'Pagination Offside Mobile', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', '0' )
    ->set_width( 20 )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_hover_image_effect', esc_html__( 'Hover Image Effect', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style',
            'value' => 'unique-limabelas',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       '1' => 'Effect 1',
       '2' => 'Effect 2',
       '3' => 'Effect 3',
       '4' => 'Effect 4',
       '5' => 'Effect 5',
       '6' => 'Effect 6',
       '7' => 'Effect 7',
       '8' => 'Effect 8',
       '9' => 'Effect 9',
       '10' => 'Effect 10',
       '11' => 'Effect 11',
       '12' => 'Effect 12',
       '13' => 'Effect 13',
       '14' => 'Effect 14',
       '15' => 'Effect 15',
       '16' => 'Effect 16'
    )),

))
->add_tab(  esc_html__( 'Content', 'portfolio-awesome' ), array( // Content Tab

    Field::make( 'select', 'portfolio_select_display_post', esc_html__( 'Select Display Post', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->add_options(
        select_display_post_tapa()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'text', 'portfolio_showcase_items', esc_html__( 'Posts Per Page', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', esc_html__('10', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->set_help_text( 'How many posts you want to show in showcase. If empty will show all portfolio posts.' ),

    Field::make( 'select', 'portfolio_showcase_order', esc_html__( 'Order', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->add_options(
        select_portfolio_awesome_order()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_select_display_post',
            'value' => '',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_showcase_order_by', esc_html__( 'Order By', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->add_options(
        select_portfolio_awesome_order_by()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_select_display_post',
            'value' => '',
            'compare' => '=',
        ),
    ) ),

	Field::make( 'multiselect', 'portfolio_showcase_cats', esc_html__( 'Select Portfolio Category', 'portfolio-awesome' ) )
    ->add_options(
    	portfolio_awesome_select_category()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_select_display_post',
            'value' => 'category',
            'compare' => '=',
        ),
    ) ),

	Field::make( 'association', 'portfolio_showcase_posts', esc_html__( 'Select Portfolio Posts', 'portfolio-awesome' ) )
    ->set_types( array(
        array(
            'type'      => 'post',
            'post_type' => 'portfolio-awesome',
        )
    ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_select_display_post',
            'value' => 'specific_post',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'multiselect', 'portfolio_showcase_category_filter', esc_html__( 'Category Filter', 'portfolio-awesome' ) )
    ->add_options(
        portfolio_awesome_select_category()
    )
    ->set_conditional_logic( array(
        'relation' => 'AND',
        array(
            'field' => 'portfolio_select_display_post',
            'value' => 'specific_post',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_select_link_post', esc_html__( 'Link Goes To', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->add_options(
        portfolio_awesome_select_link_post()
    )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'carousel',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'justified',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'slider',
            'compare' => '=',
        ),
    )),

    Field::make( 'text', 'portfolio_button_content', esc_html__( 'Button Text', 'portfolio-awesome' ) )
    ->set_width( 25 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    )),

    Field::make( 'text', 'portfolio_text_load_more', esc_html__( 'Text Load More', 'portfolio-awesome' ) )
    ->set_attribute( 'placeholder', esc_html__('Load More', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),
))
->add_tab(  esc_html__( 'Customize', 'portfolio-awesome' ), array( // Customize Tab

    Field::make( 'separator', 'portfolio_separator_layout_style', 'Layout Style' ),

    Field::make( 'color', 'portfolio_title_color', esc_html__( 'Title Color', 'portfolio-awesome' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'portfolio_content_color', esc_html__( 'Content Color', 'portfolio-awesome' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'portfolio_fact_color', esc_html__( 'Facts Color', 'portfolio-awesome' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'portfolio_number_color', esc_html__( 'Item Number Color', 'portfolio-awesome' ) )
     ->set_width( 14 ),

    Field::make( 'color', 'portfolio_bg_color', esc_html__( 'Background Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_bg_hover_color', esc_html__( 'Background Hover Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_button_text_color', esc_html__( 'Button Text Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_button_bg_color', esc_html__( 'Button Background Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_button_text_hover_color', esc_html__( 'Button Text Hover Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_button_bg_hover_color', esc_html__( 'Button Background Hover Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 ),

    Field::make( 'color', 'portfolio_overlay_color', esc_html__( 'Slider Overlay Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-full-image-1',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-hiji',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-dua',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-tilu',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-opat',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-lima',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    ) ),

    Field::make( 'number', 'portfolio_button_radius', esc_html__( 'Button Radius', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    ) ),

    Field::make( 'color', 'portfolio_frame_color', esc_html__( 'Frame Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-genep',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-tujuh',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-dalapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-salapan',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style5',
            'value' => 'slider-sapuluh',
            'compare' => '=',
        )
    ) ),

    Field::make( 'color', 'portfolio_arrow_color_special', esc_html__( 'Arrow Color', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style3',
            'value' => 'special-dua-carousel',
            'compare' => '=',
        )
    ) ),

    Field::make( 'color', 'portfolio_loading_bg', esc_html__( 'Loading Background Item', 'portfolio-awesome' ) )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'grid',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_awesome_showcase_style_main',
            'value' => 'masonry',
            'compare' => '=',
        ),
    ) )
    ->set_width( 14 ),

    Field::make( 'separator', 'portfolio_separator_filter', esc_html__( 'Filter Style', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_filter_align', esc_html__( 'Filter Align', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       'left' => 'Left',
       'center' => 'Center',
       'right' => 'Right',
    )),

    Field::make( 'number', 'portfolio_filter_margin_bottom', esc_html__( 'Filter Margin Bottom', 'portfolio-awesome' ) )
    ->set_width( 50 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_filter_color', esc_html__( 'Filter Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_filter_hover_color', esc_html__( 'Filter Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_filter_border_color', esc_html__( 'Filter Border Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_filter_mobile_color', esc_html__( 'Filter Mobile Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_filter_mobile_bg_color', esc_html__( 'Filter Mobile Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_filter',
            'value' => 'yes',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'portfolio_separator_pagination', esc_html__( 'Pagination Style', 'portfolio-awesome' ) )
     ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_infinite',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'select', 'portfolio_pagination_align', esc_html__( 'Pagination Align', 'portfolio-awesome' ) )
    ->set_width( 100 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_infinite',
            'compare' => '=',
        ),
    ) )
    ->add_options( array(
       'left' => 'Left',
       'center' => 'Center',
       'right' => 'Right',
    )),

    Field::make( 'color', 'portfolio_pag_num_color', esc_html__( 'Pagination Number Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_num_bg_color', esc_html__( 'Pagination Number Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_num_current_color', esc_html__( 'Pagination Current Number Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_num_bg_current_color', esc_html__( 'Pagination Current Number Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_number',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_def_color', esc_html__( 'Pagination Default Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_def_bg_color', esc_html__( 'Pagination Default Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_def_hover_color', esc_html__( 'Pagination Default Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_def_bg_hover_color', esc_html__( 'Pagination Default Background Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_default',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_load_color', esc_html__( 'Pagination Load More Text Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_load_bg_color', esc_html__( 'Pagination Load More Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_load_hover_color', esc_html__( 'Pagination Load More Text Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_pag_load_bg_hover_color', esc_html__( 'Pagination Load More Background Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_pagination_type',
            'value' => 'pagination_load_more',
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'portfolio_separator_arrow', esc_html__( 'Arrow Style', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_arrow_color', esc_html__( 'Pagination Arrow Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_arrow_hover_color', esc_html__( 'Pagination Arrow Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_arrow_bg_color', esc_html__( 'Pagination Background Arrow Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_arrow_bg_hover_color', esc_html__( 'Pagination Background Arrow Hover Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_arrow',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'separator', 'portfolio_separator_dot', esc_html__('Dot Style', 'portfolio-awesome' ) )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_dot_border_color', esc_html__( 'Pagination Dot Border Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

    Field::make( 'color', 'portfolio_dot_bg_color', esc_html__( 'Pagination Dot Background Color', 'portfolio-awesome' ) )
    ->set_width( 14 )
    ->set_alpha_enabled( true )
    ->set_conditional_logic( array(
        'relation' => 'OR',
        array(
            'field' => 'portfolio_use_pagination',
            'value' => true,
            'compare' => '=',
        ),
    ) ),

));