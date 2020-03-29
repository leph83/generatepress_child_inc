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
    // $fonts[] = 'My Font Name';
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
 * Author Link
 */
add_filter( 'generate_post_author','tu_autho_link' );
function tu_autho_link() {
    return 'false';
}



/**
 * Reduce Number of Fonts
 */
add_filter( 'generate_number_of_fonts','tu_show_fifty_google_fonts' );
function tu_show_fifty_google_fonts() {
	return 0;
}

add_filter( 'generate_typography_customize_list', 'tu_add_google_fonts' );
function tu_add_google_fonts( $fonts ) {
	$fonts[ 'open_sans' ] = array( 
		'name' => 'Open Sans',
		'variants' => array( '400', '500', '700' ),
		'category' => 'sans-serif'
	);
	$fonts[ 'roboto' ] = array( 
		'name' => 'Roboto',
		'variants' => array( '300', '300i', '400', '400i', '500', '500i', '600', '600i', '700', '700i' ),
		'category' => 'sans-serif'
	);

	$fonts[ 'lato' ] = array( 
		'name' => 'Lato',
		'variants' => array( '300', '300i', '400', '400i', '500', '500i', '600', '600i', '700', '700i' ),
		'category' => 'sans-serif'
	);

	$fonts[ 'montserrat' ] = array( 
		'name' => 'Montserrat',
		'variants' => array( '300', '300i', '400', '400i', '500', '500i', '600', '600i', '700', '700i' ),
		'category' => 'sans-serif'
	);

	return $fonts;
}




/**
 * Remove GP Customizer options
 */
// add_action( 'after_setup_theme','tu_remove_customizer_options', 1000 );
// function tu_remove_customizer_options( $wp_customize ) {
// 	remove_action( 'customize_register', 'generate_customize_register' );
// 	remove_action( 'customize_register', 'generate_default_fonts_customize_register' );
// 	remove_action( 'customize_register', 'generate_backgrounds_customize', 999 );
// 	remove_action( 'customize_register', 'generate_backgrounds_secondary_nav_customizer', 1000 );
// 	remove_action( 'customize_register', 'generate_blog_customize_register', 99 );
// 	remove_action( 'customize_register', 'generate_colors_customize_register' );
// 	remove_action( 'customize_register', 'generate_colors_secondary_nav_customizer', 1000 );
// 	remove_action( 'customize_register', 'generate_colors_wc_customizer', 100 );
// 	remove_action( 'customize_register', 'generate_copyright_customize_register' );
// 	remove_action( 'customize_register', 'generate_menu_plus_customize_register', 100 );
// 	remove_action( 'customize_register', 'generate_page_header_blog_customizer', 99 );
// 	remove_action( 'customize_register', 'generate_secondary_nav_customize_register', 100 );
// 	remove_action( 'customize_register', 'generate_spacing_customize_register', 99 );
// 	remove_action( 'customize_register', 'generate_fonts_customize_register' );
// }