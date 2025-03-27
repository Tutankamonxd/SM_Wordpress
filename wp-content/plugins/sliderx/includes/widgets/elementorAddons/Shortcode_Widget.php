<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor SliderX Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class SliderX_Widget extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sliderx-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'SliderX', 'sliderx' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		// return SLIDERX_DIR_PATH . 'assets/images/icon.png';
		return 'eicon-slides';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'slider', 'sliderx', 'carousel', 'slider carousel' ];
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_script_depends() {
		return ['sliderx-swiper-js', 'sliderx-widget-js' ];
	}


	public function get_style_depends() {
		return ['sliderx-swiper-css', 'sliderx-animate-css', 'sliderx-css', 'sliderx-style'];
	}



	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		// Register styles and scripts
		wp_register_style( 'sliderx-swiper-css', SLIDERX_DIR_URI . 'assets/css/swiper.min.css' );
		wp_register_style( 'sliderx-animate-css', SLIDERX_DIR_URI . 'assets/css/animate.min.css' );
		wp_register_style( 'sliderx-css', SLIDERX_DIR_URI . 'assets/css/sliderx.css' );

		wp_register_script( 'sliderx-swiper-js', SLIDERX_DIR_URI . 'assets/js/swiper.min.js', array(), time(), true );
		wp_register_script( 'sliderx-widget-js', SLIDERX_DIR_URI . 'assets/js/sliderx-widgets.js', array( 'sliderx-swiper-js' ), time(), true );
	}



	/**
	 * Get widget promotion data.
	 *
	 * Retrieve the widget promotion data.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return array Widget promotion data.
	 */
	protected function get_upsale_data() {
		return [
			'condition' => true,
			'image' => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
			'image_alt' => esc_attr__( 'Upgrade', 'elementor-list-widget' ),
			'title' => esc_html__( 'Promotion heading', 'elementor-list-widget' ),
			'description' => esc_html__( 'Get the premium version of the widget with additional styling capabilities.', 'elementor-list-widget' ),
			'upgrade_url' => esc_url( 'https://example.com/upgrade-to-pro/' ),
			'upgrade_text' => esc_html__( 'Upgrade Now', 'elementor-list-widget' ),
		];
	}

	// public function sliderx_shortcode_data(){
	public function sliderx_shortcode_data() {
		global $wpdb;
	
		// Initialize the array to hold the shortcode data
		$shortcode_list = array();
	
		// Fetch the relevant data from the database
		$sliderx_shortcodes = $wpdb->get_results("
			SELECT settings_data.sliderId, settings_data.sliderType, settings_data.sliderTitle
			FROM {$wpdb->prefix}sliderx_settings AS settings_data
			INNER JOIN {$wpdb->prefix}sliderx_data AS sliderxData ON settings_data.sliderId = sliderxData.sliderId
			ORDER BY sliderxData.sliderId DESC
		");

		// Populate the array with sliderId|sliderType as key => sliderTitle as value
		foreach ($sliderx_shortcodes as $shortcode) {
			$shortcode_list[$shortcode->sliderId . '|' . $shortcode->sliderType] = $shortcode->sliderTitle;
		}
		return $shortcode_list;
	}
	
	

	/**
	 * Controls register.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'sliderx' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		// Get the options array
		$shortcode_options = $this->sliderx_shortcode_data();

		// Set a default option (e.g., the first item in the array)
		$default_key = !empty($shortcode_options) ? array_key_first($shortcode_options) : '';

		$this->add_control(
			'sliderx_shortcode',
			array(
				'label'       => __( 'SliderX Shortcode(s)', 'sliderx' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => $default_key, // Set the default value
				'options'     => $shortcode_options,
			)
		);

	}


	/**
	 * Render sliderX shortcode widget output on the frontend.
	 *
	 * @since 2.4.1
	 * @access protected
	 */
	protected function render() {

		$settings  = $this->get_settings_for_display();
		$sliderX_shortcode = $settings['sliderx_shortcode'];
		if ( '' === $sliderX_shortcode ) {
			echo '<div style="text-align: center; margin-top: 0; padding: 10px" class="elementor-add-section-drag-title">Select a shortcode</div>';
			return;
		}
		// Split the selected option into sliderId and sliderType
		list($sliderId, $sliderType) = explode('|', $sliderX_shortcode);

		echo do_shortcode( '[sliderX type="' . esc_attr($sliderType) . '" id="' . esc_attr($sliderId) . '"]' );
	}


}
