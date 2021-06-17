<?php
/**
 * Customizer section options.
 *
 * @package assentpress
 *
 */

function assentpress_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'consultstreet_footer_copright_text',
			array(
				'sanitize_callback' =>  'assentpress_sanitize_text',
				'default' => __('Copyright &copy; 2021 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> AssentPress theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'assentpress'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('consultstreet_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','assentpress'),
				'section' => 'consultstreet_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));
		
		
		// Header Banner Image
		$wp_customize->add_setting( 'consultstreet_header_banner_image', array(
				'sanitize_callback' => 'esc_url_raw',
				'default' => '',
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'consultstreet_header_banner_image',
			array(
				'label'    => esc_html__( 'Add Header Banner Image', 'assentpress' ),
				'description'    => esc_html__( 'You can use this option only for Magazine Header', 'assentpress' ),
				'section'  => 'title_tagline',
				'settings' => 'consultstreet_header_banner_image',
				'priority'        => 55,
			)
		));

}
add_action( 'customize_register', 'assentpress_customizer_theme_settings' );

function assentpress_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}
