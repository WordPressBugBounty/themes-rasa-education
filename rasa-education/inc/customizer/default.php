<?php
/**
 * Default theme options.
 *
 * @package Rasa Education
 */

if ( ! function_exists( 'rasa_education_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function rasa_education_get_default_theme_options() {

	$rasa_education_defaults = array();

	// Contact Details
	$rasa_education_defaults['rasa_education_show_contact_details'] 		= true;
	$rasa_education_defaults['rasa_education_address_one']				= esc_html__('214 West Arnold St','rasa-education');
	$rasa_education_defaults['rasa_education_address_two']				= esc_html__('New York, NY 10002','rasa-education');
	$rasa_education_defaults['rasa_education_phone_number']				= esc_html__('(007) 123 456 7890','rasa-education');
	$rasa_education_defaults['rasa_education_opening_time']				= esc_html__('Mon-Fri 10:00am-7:30pm','rasa-education');
	$rasa_education_defaults['rasa_education_email_id']					= esc_html__('info@example.com','rasa-education');
	$rasa_education_defaults['rasa_education_support_text']				= esc_html__('24 X 7 online support','rasa-education');

	// Menu
	$rasa_education_defaults['rasa_education_show_menu_button'] 			= true;
	$rasa_education_defaults['rasa_education_menu_button_text']			= esc_html__('Apply Now','rasa-education');
	$rasa_education_defaults['rasa_education_menu_button_url']			= esc_url('#','rasa-education');

	// Front Page Header Image
	$rasa_education_defaults['enable_frontpage_header_image']  = false;

	//General Section
	$rasa_education_defaults['readmore_text']					= esc_html__('Read More','rasa-education');
	$rasa_education_defaults['your_latest_posts_title']			= esc_html__('Blog','rasa-education');
	$rasa_education_defaults['excerpt_length']					= 10;
	$rasa_education_defaults['layout_options_blog']				= 'no-sidebar';
	$rasa_education_defaults['layout_options_archive']			= 'no-sidebar';
	$rasa_education_defaults['layout_options_page']				= 'no-sidebar';	
	$rasa_education_defaults['layout_options_single']			= 'right-sidebar';	

	//Footer section 		
	$rasa_education_defaults['copyright_text']					= esc_html__( 'Copyright &copy; All rights reserved.', 'rasa-education' );

	// Pass through filter.
	$rasa_education_defaults = apply_filters( 'rasa_education_filter_default_theme_options', $rasa_education_defaults );
	return $rasa_education_defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'rasa_education_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function rasa_education_get_option( $key ) {

		$rasa_education_default_options = rasa_education_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$rasa_education_theme_options = (array)get_theme_mod( 'theme_options' );
		$rasa_education_theme_options = wp_parse_args( $rasa_education_theme_options, $rasa_education_default_options );

		$value = null;

		if ( isset( $rasa_education_theme_options[ $key ] ) ) {
			$value = $rasa_education_theme_options[ $key ];
		}

		return $value;

	}

endif;