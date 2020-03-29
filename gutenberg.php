<?php 

/**
 * Theme Colors for Gutenberg
 */
add_action( 'after_setup_theme', 'gutenberg_default_colors' );
function gutenberg_default_colors($theme_colors) {
    if ( !function_exists( 'wtp_theme_colors' ) ) {
		return;
	}
    add_theme_support( 'editor-color-palette', wtp_theme_colors() );
}

/**
 * Disable Custom Font Size Option
 */
add_theme_support( 'disable-custom-font-sizes' );
