<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make( 'post_meta', 'portfolio_repeater_cont', esc_html('Portfolio Awesome') )
->where( 'post_type', '=', 'portfolio-awesome' )
->set_priority( 'high' )
->add_fields( array(


	Field::make( 'text', 'portfolio_sub_title', esc_html__( 'Subtitle', 'portfolio-awesome' ) )
	->set_attribute( 'placeholder', 'Your Subtitle' )
	->set_width( 33 ),

	Field::make( 'text', 'portfolio_custom_link', esc_html__( 'Custom Link', 'portfolio-awesome' ) )
	->set_attribute( 'placeholder', 'https://' )
	->set_width( 33 ),

	Field::make( 'complex', 'portfolio_facts', esc_html__( 'Facts List', 'portfolio-awesome' ) )
	->add_fields( array(

		Field::make( 'text', 'portfolio_facts_name', esc_html__( 'Fact Name', 'portfolio-awesome' ) )
		->set_attribute( 'placeholder', 'Client' )
		->set_width( 33 ),

		Field::make( 'text', 'portfolio_facts_value', esc_html__( 'Fact Value', 'portfolio-awesome' ) )
		->set_attribute( 'placeholder', 'John Doe' )
		->set_width( 33 ),

		Field::make( 'checkbox', 'use_portfolio_facts', esc_html__( 'Show Fact In Showcase', 'portfolio-awesome' ) )
	    ->set_width( 33 )
	    ->set_option_value( 'yes' ),

	) )
	->set_default_value( array(
		array(
		),
	) ),
));
