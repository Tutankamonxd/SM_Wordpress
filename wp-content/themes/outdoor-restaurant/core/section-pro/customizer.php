<?php 
/**
 * Theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Outdoor_Restaurant_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/core/section-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Outdoor_Restaurant_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Outdoor_Restaurant_Customize_Section_Pro( $manager,'outdoor_restaurant_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Outdoor Restaurant Pro', 'outdoor-restaurant' ),
			'pro_text' => esc_html__( 'Upgrade Pro', 'outdoor-restaurant' ),
			'pro_url'  => esc_url('https://www.thealphablocks.com/themes/outdoor-restaurant-wordpress-theme/'),
			'bundle_text' => esc_html__( 'Get All Our Themes', 'outdoor-restaurant' ),
			'bundle_url'  => esc_url('https://www.thealphablocks.com/themes/wordpress-theme-bundle/'),
		) )	);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_style( 'outdoor-restaurant-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Outdoor_Restaurant_Customize::get_instance();