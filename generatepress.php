<?php

// https://docs.generatepress.com/collection/filters/


/**
 * Add a custom class to the body element
 */
add_filter( 'body_class','tu_add_body_class' );
function tu_add_body_class( $classes ) {
	if ( !function_exists( 'wtp_additional_class_modifier' ) ) {
		return;
	}

	$classes[] = 'body--' . wtp_additional_class_modifier();
	return $classes;
}

/**
 * Add a custom class to the main element
 */
add_filter( 'generate_main_class','tu_add_main_class' );
function tu_add_main_class( $classes ) {
	if ( !function_exists( 'wtp_additional_class_modifier' ) ) {
		return;
	}

	$classes[] = 'main--' . wtp_additional_class_modifier();
	return $classes;
}



/**
 * 404 Title
 */
add_filter( 'generate_404_title', 'tu_404_title' );
function tu_404_title()
{ 
    return '404';
}

/**
 * 404 Text
 */
add_filter( 'generate_404_text', 'tu_404_text' );
function tu_404_text()
{ 
    return 'Die Seite konnte nicht gefunden werden';
}

/**
 * generate show title
 */
add_action( 'after_setup_theme', 'tu_remove_all_titles' );
function tu_remove_all_titles() {
    add_filter( 'generate_show_title', '__return_false' );
}

/**
 * color palette
 */
add_filter( 'generate_default_color_palettes', 'tu_custom_color_palettes' );
function tu_custom_color_palettes( $palettes ) {
	if ( !function_exists( 'wtp_theme_colors' ) ) {
		return;
	}
		
	$palettes = array();
	$theme_colors = wtp_theme_colors();

	if ( !empty($theme_colors) ) {	
		foreach ($theme_colors as $key => $value) {
			array_push($palettes, $value['color']);
		}
	}

	return $palettes;
}

/**
 * typography default fonts
 */
add_filter( 'generate_typography_default_fonts','tu_add_system_fonts' );
function tu_add_system_fonts( $fonts ) {
	if ( function_exists('wtp_font') ) {
		$systemfonts = wtp_font() ?? false;

		foreach ($systemfonts as $key => $systemfont) {
			$fonts[] = $systemfont;
		}
	}

    return $fonts;
}

/**
 * Leave a comment
 */
add_filter( 'generate_leave_comment','tu_custom_leave_comment' );
function tu_custom_leave_comment() {
    return 'Hinterlasse einen Kommentar';
}

/**
 * Search Placeholder
 */
add_filter( 'generate_search_placeholder','tu_search_placeholder' );
function tu_search_placeholder() {
    return 'Suche';
}


/**
 * Number of Fonts
 */
add_filter( 'generate_number_of_fonts','tu_show_fifty_google_fonts' );
function tu_show_fifty_google_fonts() {
	return 'all';
}
