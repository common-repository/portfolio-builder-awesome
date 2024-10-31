<?php
namespace Elementor;

function portfolio_awesome_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'portfolio_awesome-general-category',
		[
			'title'  => 'Portfolio Awesome',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\portfolio_awesome_general_elementor_init');
