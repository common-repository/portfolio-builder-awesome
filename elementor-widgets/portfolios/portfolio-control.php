<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class portfolio_awesome_post_block extends Widget_Base {

	public function get_name() {
		return 'portfolio_awesome-post-block';
	}

	public function get_title() {
		return esc_html__( 'Portfolios', 'portfolio-awesome' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'portfolio_awesome-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_portfolio_awesome_post_block_post_setting',
			[
				'label' => esc_html__( 'Post Setting', 'portfolio-awesome' ),
			]
		);

		$this->add_control(
			'portfolio_awesome_select_showcase_post',
			[
				'label' => esc_html__( 'Select Showcase', 'portfolio-awesome' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => portfolio_awesome_select_showcase_post(),
				'description' => esc_html__( 'Select post order by (default to latest post).', 'portfolio-awesome' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_portfolio_awesome_block_setting',
			[
				'label' => esc_html__( 'Typography', 'portfolio-awesome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_portfolio_name_typography',
				'label' => esc_html__( 'Title Typography', 'portfolio-awesome' ),
				'selector' => '{{WRAPPER}} .portfolio__content h3, {{WRAPPER}} h1.portfolio__content, {{WRAPPER}} .special-hiji .grid__item--title, {{WRAPPER}} .special-dua .slide__title, {{WRAPPER}} .inner-slider h1, {{WRAPPER}} .slideshow-slider .slide__title, {{WRAPPER}} .slider__text-inner, {{WRAPPER}} .slider .link-button a, {{WRAPPER}} .slider-inner-wrap .grid__item--name',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_portfolio_job_typography',
				'label' => esc_html__( 'Facts Typography', 'portfolio-awesome' ),
				'selector' => '{{WRAPPER}} .fact-list li, {{WRAPPER}} span.portfolio-job, {{WRAPPER}} figcaption span, {{WRAPPER}} .special-hiji .caption, {{WRAPPER}} .special-dua .slide__side, {{WRAPPER}} .slider-inner-wrap .grid__item--title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_portfolio_content_typography',
				'label' => esc_html__( 'Content Typography', 'portfolio-awesome' ),
				'selector' => '{{WRAPPER}} .inner-slider p, {{WRAPPER}} .slideshow-slider .slide__desc, {{WRAPPER}} .slider-inner-wrap .grid__item--text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typhography_portfolio_button_typography',
				'label' => esc_html__( 'Button Typography', 'portfolio-awesome' ),
				'selector' => '{{WRAPPER}} .portfolio-block-item figcaption a, {{WRAPPER}} .inner-slider a, {{WRAPPER}} .justify-item figcaption a, {{WRAPPER}} .slideshow-slider .slide__link',
			]
		);
	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$portfolio_awesome_select_showcase_post 			= ! empty( $instance['portfolio_awesome_select_showcase_post'] ) ? $instance['portfolio_awesome_select_showcase_post'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/portfolio-block.php' );

		?>

		<?php 
		if($portfolio_style == 'special-hiji-carousel') { ?>
		<script>
			<?php include PORTFOLIO_AWESOME_DIR .'/public/js/special1-in.js'; ?>
		</script>
		<?php } elseif ($portfolio_style == 'special-dua-carousel') { ?>

		<script>
			<?php include PORTFOLIO_AWESOME_DIR .'/public/js/special2-in.js'; ?>
		</script>
		<?php } elseif ($portfolio_style == 'special-tilu-carousel') { ?>

		<script>
			<?php include PORTFOLIO_AWESOME_DIR .'/public/js/special1-in.js'; ?>
		</script>
		<?php } ?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new portfolio_awesome_post_block() );