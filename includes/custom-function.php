<?php

function portfolio_facts_showcase($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if($portfolio_fact['use_portfolio_facts'] == true) {
				echo wp_specialchars_decode( "<li class='facts-name'>". esc_html( $portfolio_fact['portfolio_facts_name'] ) ."</li>" );
				echo wp_specialchars_decode( "<li class='facts-value'>". esc_html( $portfolio_fact['portfolio_facts_value'] ) ."</li>" );
			}
		}
	}

}

function portfolio_facts_single($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );

	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if(!empty($portfolio_fact['portfolio_facts_name']) || !empty($portfolio_fact['portfolio_facts_value'])) {
				echo wp_specialchars_decode( "<li class='facts-name'>". esc_html( $portfolio_fact['portfolio_facts_name'] ) ."</li>" );
				echo wp_specialchars_decode( "<li class='facts-value'>". esc_html( $portfolio_fact['portfolio_facts_value'] ) ."</li>" );
			}
		}
	}

}

function portfolio_facts_showcase_tilubelas() {

	$portfolio_facts = carbon_get_the_post_meta('portfolio_facts' );
	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if($portfolio_fact['use_portfolio_facts'] == true) {
				echo esc_html( $portfolio_fact['portfolio_facts_value'] . " " );
			}

		}
	}

}

function portfolio_facts_showcase_opatbelas($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if($portfolio_fact['use_portfolio_facts'] == true) {
				echo wp_specialchars_decode( "<li>". esc_html( $portfolio_fact['portfolio_facts_name'] ) ." : ". esc_html( $portfolio_fact['portfolio_facts_value'] ) . "</li>" );

			}
		}
	}

}

function portfolio_facts_showcase_grid_image($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if($portfolio_fact['use_portfolio_facts'] == true) {
				echo wp_specialchars_decode( "<li>" . esc_html( $portfolio_fact['portfolio_facts_value'] ) . "</li>" );

			}
		}
	}

}

function portfolio_facts_showcase_value($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {
		foreach ($portfolio_facts as $portfolio_fact) {
			if($portfolio_fact['use_portfolio_facts'] == true) {
				echo esc_html( $portfolio_fact['portfolio_facts_value'] );

			}
		}
	}

}

function portfolio_facts_showcase_genep($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {

		foreach ($portfolio_facts as $portfolio_fact) {

				echo wp_specialchars_decode( "<li class='section__facts-item'>" );
				echo wp_specialchars_decode( "<h3 class='section__facts-title'>" . esc_html( $portfolio_fact['portfolio_facts_name'] ) . "</h3>" );
				echo wp_specialchars_decode( "<span class='section__facts-detail'>" . esc_html( $portfolio_fact['portfolio_facts_value'] ) . "</span>" );
				echo wp_specialchars_decode( "</li>" );


		}

	}

}

function portfolio_facts_single_style($post_id) {

	$portfolio_facts = carbon_get_post_meta($post_id, 'portfolio_facts' );
	if(!empty($portfolio_facts)) {

		foreach ($portfolio_facts as $portfolio_fact) {
			echo esc_html( $portfolio_fact['portfolio_facts_name'] ) . ' <strong>' . esc_html( $portfolio_fact['portfolio_facts_value'] ) . ' </strong>';
		}

	}

}