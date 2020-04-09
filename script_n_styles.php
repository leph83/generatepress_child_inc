<?php
 /**
 * Add Custom Style CSS
 */
function generatepress_child_enqueue_scripts() {
	$version = '';
	$test = false;

	if ( function_exists('wtp_version') ) {
		$version = wtp_version();
	}
	if ( function_exists('wtp_test') ) {
		$test = wtp_test();
	}

	wp_enqueue_style( 'style-theme', trailingslashit( get_stylesheet_directory_uri() ) . 'css/style.css', '', $version );
	wp_enqueue_style( 'style-gutenberg', trailingslashit( get_stylesheet_directory_uri() ) . 'css/gutenberg.css', '', $version );

	if ($test == true) {
		wp_enqueue_style( 'style-test', trailingslashit( get_stylesheet_directory_uri() ) . 'css/test.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );



/**
 * Add Custom Gutenberg Styles to admin
 */
function gutenberg_styles() {
	wp_enqueue_script( 'wtp-gutenberg-styles-js', trailingslashit( get_stylesheet_directory_uri() ) . 'js/gutenberg-styles.js', array('wp-blocks'), '2020', true );
	wp_enqueue_style( 'style-gutenberg', trailingslashit( get_stylesheet_directory_uri() ) . 'css/gutenberg.css' );

}
add_action('admin_enqueue_scripts', 'gutenberg_styles');






/**
 * Remove Child Theme Default CSS File
 */
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'generate-child' );
}, 50 );

/**
 * Newer Jquery Version
 */
function replace_core_jquery_version() {
	if (!is_admin()) {
		wp_deregister_script( 'jquery' );
		// Online Jquery
		// wp_register_script( 'jquery', "https://code.jquery.com/jquery-3.4.1.min.js", array(), '3.4.1' );

		// Local Jquery
		wp_register_script('jquery', trailingslashit( get_stylesheet_directory_uri() ) . 'js/jquery-3.4.1.min.js', false, '3.4.1');
	}
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );
