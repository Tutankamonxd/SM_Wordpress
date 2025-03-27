<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Outdoor_Restaurant_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'outdoor-restaurant';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $bundle_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $bundle_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		$json['bundle_text'] = $this->bundle_text;
		$json['bundle_url']  = esc_url( $this->bundle_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<div class="bundle-box">
					<# if ( data.pro_text && data.pro_url ) { #>
						<a target="_blank" href="{{ data.pro_url }}" class="button button-secondary alignright">{{ data.pro_text }}</a>
					<# } #>

					<# if ( data.bundle_text && data.bundle_url ) { #>
						<a target="_blank" href="{{ data.bundle_url }}" class="bundle-btn button button-secondary alignright">{{ data.bundle_text }}</a>
					<# } #>
				</div>
				
			</h3>
		</li>
	<?php }
}