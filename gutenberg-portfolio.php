<?php

use Carbon_Fields\Field;
use Carbon_Fields\Block;

// For Gutenberg Blocks
Block::make( esc_html( 'Portfolio Awesome' ) )
->add_fields( array(
	Field::make( 'association', 'portfolio_gutenberg_block', esc_html__( 'Portfolio Awesome Post', 'portfolio-awesome' ) )
	->set_min( 1 )
	->set_max( 1 )
	->set_types( array(
		array(
			'type'      => 'post',
			'post_type' => 'showcase-awesome',
		)
	) )
) )
->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
	require dirname( __FILE__ ) .'/gutenberg-blocks/portfolio-block.php';
} );