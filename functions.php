<?php
/**
 * Theme functions and definitions
 *
 * @package AssentPress
 */

/**
 * After setup theme hook
 */
function assentpress_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'assentpress', get_stylesheet_directory() . '/languages' );	
	require get_stylesheet_directory() . '/inc/customizer/assentpress-customizer-options.php';
}
add_action( 'after_setup_theme', 'assentpress_theme_setup' );

/**
 * Load assets.
 */

function assentpress_theme_css() {
	wp_enqueue_style( 'assentpress-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('assentpress-child-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('assentpress-default-css', get_stylesheet_directory_uri() . "/assets/css/theme-default.css" );
    wp_enqueue_style('assentpress-bootstrap-smartmenus-css', get_stylesheet_directory_uri() . "/assets/css/bootstrap-smartmenus.css" ); 
    wp_enqueue_script('assentpress-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js');	
}
add_action( 'wp_enqueue_scripts', 'assentpress_theme_css', 99);

/**
 * Import Options From Parent Theme
 *
 */
function assentpress_parent_theme_options() {
	$consultstreet_mods = get_option( 'theme_mods_consultstreet' );
	if ( ! empty( $consultstreet_mods ) ) {
		foreach ( $consultstreet_mods as $consultstreet_mod_k => $consultstreet_mod_v ) {
			set_theme_mod( $consultstreet_mod_k, $consultstreet_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'assentpress_parent_theme_options' );

/**
 * Fresh site activate
 *
 */
$fresh_site_activate = get_option( 'fresh_assentpress_site_activate' );
if ( (bool) $fresh_site_activate === false ) {
	set_theme_mod( 'consultstreet_menu_container_size', 'container' );
	set_theme_mod( 'consultstreet_top_header_container_size', 'container' );
	set_theme_mod( 'consultstreet_footer_container_size', 'container' );
	set_theme_mod( 'consultstreet_theme_color', 'theme-red' );
	update_option( 'fresh_assentpress_site_activate', true );
}

/**
 * Page header
 *
 */
function assentpress_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'assentpress_custom_header_args', array(
		'default-image'      => get_stylesheet_directory_uri().'/assets/img/page-header.jpg',
		'default-text-color' => '000',
		'width'              => 1920,
		'height'             => 500,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'assentpress_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'assentpress_custom_header_setup' );

/**
 * Remove Parent Theme Setting
 *
 */
function assentpress_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_setting('consultstreet_sticky_bar_logo');
}
add_action( 'customize_register', 'assentpress_remove_parent_setting',99 );

function assentpress_custom_customizer_options() { 
$assentpress_main_slider_content_color = get_theme_mod('consultstreet_main_slider_content_color', '#fff');
?>
    <style type="text/css">
		<?php if($assentpress_main_slider_content_color != null) : ?>
		.theme-slider-content .title-large{ color: <?php echo $assentpress_main_slider_content_color; ?>;}
		.theme-slider-content .description{ color: <?php echo $assentpress_main_slider_content_color; ?>;}
		<?php endif; ?>
   </style>
<?php }
add_action('wp_footer','assentpress_custom_customizer_options');

if ( ! function_exists( 'assentpress_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see assentpress_custom_header_setup().
	 */
	function assentpress_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?> !important;
			}

			<?php endif; ?>
		</style>
		<?php
	}
endif;