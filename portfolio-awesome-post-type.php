<?php
/*-----------------------------------------------------------------------------------*/
/* TImeline Awesome Post Type
/*-----------------------------------------------------------------------------------*/


add_action('init', 'portfolio_awesome_register');

function portfolio_awesome_register() {

	$portfolio_awesome_rewrite_slug = carbon_get_theme_option( 'portfolio_awesome_rewrite_slug' );

	$labels = array(
		'name'                => esc_html_x( 'Portfolio', 'Post Type General Name', 'portfolio-awesome' ),
		'singular_name'       => esc_html_x( 'Portfolio', 'Post Type Singular Name', 'portfolio-awesome' ),
		'menu_name'           => esc_html__( 'Portfolio', 'portfolio-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Portfolio:', 'portfolio-awesome' ),
		'all_items'           => esc_html__( 'Portfolio Item', 'portfolio-awesome' ),
		'view_item'           => esc_html__( 'View Portfolio', 'portfolio-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Portfolio', 'portfolio-awesome' ),
		'add_new'             => esc_html__( 'Add New Portfolio', 'portfolio-awesome' ),
		'edit_item'           => esc_html__( 'Edit Portfolio', 'portfolio-awesome' ),
		'update_item'         => esc_html__( 'Update Portfolio', 'portfolio-awesome' ),
		'search_items'        => esc_html__( 'Search Portfolio', 'portfolio-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'portfolio-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'portfolio-awesome' ),
	);

	if(empty($portfolio_awesome_rewrite_slug)) {
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> 'portfolio',
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'				=> array( 'slug' => 'portfolio' ),
			'supports'				=> array('title','editor','thumbnail', 'page-attributes'),
			'show_in_rest'			=> true,
			'menu_position'			=> 7,
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'menu_icon'				=> 'dashicons-layout',
		);
	}
	else {
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => 'portfolio',
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'rewrite'            => array( 'slug' => $portfolio_awesome_rewrite_slug ),
			'supports'           => array('title','editor','thumbnail'),
			'menu_position'       => 7,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'menu_icon'           => 'dashicons-layout',
		);
	}

	register_post_type( 'portfolio-awesome', $args );

	add_theme_support( 'post-thumbnails', array( 'portfolio-awesome' ) );

	register_taxonomy(
		"portfolio-category", array("portfolio-awesome"), array(
		"hierarchical"    => true,
		"label"       => "Categories",
		"singular_label"  => "Categories",
		'show_in_rest' => true,
		'show_admin_column' => true,
		"rewrite"     => true)
	);

	register_taxonomy_for_object_type('portfolio-category', 'portfolio-awesome');

	$labels2 = array(
		'name'                => esc_html_x( 'Showcase', 'Post Type General Name', 'portfolio-awesome' ),
		'singular_name'       => esc_html_x( 'Showcase', 'Post Type Singular Name', 'portfolio-awesome' ),
		'menu_name'           => esc_html__( 'Showcase', 'portfolio-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Showcase:', 'portfolio-awesome' ),
		'all_items'           => esc_html__( 'Showcase', 'portfolio-awesome' ),
		'view_item'           => esc_html__( 'View Showcase', 'portfolio-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Showcase', 'portfolio-awesome' ),
		'add_new'             => esc_html__( 'Add New Showcase', 'portfolio-awesome' ),
		'edit_item'           => esc_html__( 'Edit Showcase', 'portfolio-awesome' ),
		'update_item'         => esc_html__( 'Update Showcase', 'portfolio-awesome' ),
		'search_items'        => esc_html__( 'Search Showcase', 'portfolio-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'portfolio-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'portfolio-awesome' ),
	);
	$args2 = array(
		'labels'             	=> $labels2,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_ui'            	=> true,
		'query_var'          	=> 'showcase',
		'capability_type'    	=> 'post',
		'hierarchical'       	=> false,
		'rewrite'            	=> array( 'slug' => 'showcase' ),
		'supports'           	=> array('title'),
		'menu_position'      	=> 7,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'show_in_menu' 			=> 'edit.php?post_type=portfolio-awesome',
	);
	register_post_type( 'showcase-awesome', $args2 );

}

function portfolio_awesome_select_category() {
	$output_categories2 = array();
	$category_terms = get_terms(array('portfolio-category','hide_empty' => true));

	foreach($category_terms as $category) {
		$output_categories2[$category->slug] = $category->name;
	}

	return $output_categories2;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'portfolio_awesome_showcase_field_in_post' );
function portfolio_awesome_showcase_field_in_post() {

	require dirname( __FILE__ ) .'/portfolio-awesome-showcase-fields.php';

}

add_action( 'carbon_fields_register_fields', 'portfolio_awesome_field_in_post' );
function portfolio_awesome_field_in_post() {

	require dirname( __FILE__ ) .'/portfolio-awesome-fields.php';

}

add_action( 'carbon_fields_register_fields', 'portfolio_awesome_field_general_setting' );
function portfolio_awesome_field_general_setting() {

	Container::make( 'theme_options', 'portfolio_awesome_general_setting', esc_html__( 'Settings', 'portfolio-awesome' ) )
	->set_page_parent( 'edit.php?post_type=portfolio-awesome' )
	->add_fields( array(
		Field::make( 'text', 'portfolio_awesome_rewrite_slug', esc_html__( 'Single Portfolio Slug', 'portfolio-awesome' ) ),
		Field::make( 'number', 'portfolio_awesome_single_width', esc_html__( 'Single Portfolio Width (px)', 'portfolio-awesome' ) ),
		Field::make( 'number', 'portfolio_awesome_single_padding_top', esc_html__( 'Single Portfolio Padding Top (px)', 'portfolio-awesome' ) ),
		Field::make( 'number', 'portfolio_awesome_single_padding_bottom', esc_html__( 'Single Portfolio Padding Bottom (px)', 'portfolio-awesome' ) ),
		Field::make( 'number', 'portfolio_awesome_single_header_height', esc_html__( 'Single Portfolio Header Height (px)', 'portfolio-awesome' ) ),
		Field::make( 'text', 'portfolio_awesome_read_more', esc_html__( 'Read More Text', 'portfolio-awesome' ) ),
		Field::make( 'color', 'portfolio_single_title_color', esc_html__( 'Title Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_title_active_color', esc_html__( 'Title Active Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_subtitle_color', esc_html__( 'Subtitle Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_subtitle_active_color', esc_html__( 'Subtitle Active Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_fact_color', esc_html__( 'Fact Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_content_color', esc_html__( 'Content Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_read_more_color', esc_html__( 'Read More Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_arrow_color', esc_html__( 'Arrow Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
		Field::make( 'color', 'portfolio_single_bg_color', esc_html__( 'Background Content Color', 'portfolio-awesome' ) )
     	->set_width( 14 ),
	) );
}