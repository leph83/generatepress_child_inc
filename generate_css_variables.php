<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'wtp_base_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function wtp_base_css() {
		if ( ! function_exists( 'generate_get_defaults' ) || ! class_exists( 'GeneratePress_CSS' ) ) {
			return;
		}

        // Variables
        $css = new GeneratePress_CSS;

        $generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
        );
    
        $color_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_color_defaults()
		);

        $spacing_settings = wp_parse_args(
            get_option( 'generate_spacing_settings', array() ),
            generate_spacing_get_defaults()
        );        

        $nav_drop_point = generate_get_option( 'nav_drop_point' );

        $media_query_min_width_desktop = sprintf(
            '%2$s',
            absint( $nav_drop_point ) . 'px',
            apply_filters( 'generate_not_mobile_menu_media_query', '(min-width: 769px)' )
        );
        $media_query_min_width_container = '(min-width: ' . esc_attr( $generate_settings['container_width'] ) . 'px' . ')';

        $content_padding = absint( $spacing_settings['content_right'] ) + absint( $spacing_settings['content_left'] );
        $width_with_padding = esc_attr( $generate_settings['container_width'] + $content_padding ) . 'px';


        /*
         * CSS
         */

        // SET CSS VARIABLES
        $css->set_selector( ':root' );
            // Container Width
            $css->add_property( '--container-width', esc_attr( $generate_settings['container_width'] ) . 'px');
            // Container Padding
            $css->add_property( '--gutter-left', absint( $spacing_settings['mobile_content_left'] ) . 'px');
            $css->add_property( '--gutter-right', absint( $spacing_settings['mobile_content_right'] ) . 'px');
            $css->add_property( '--gutter-top', absint( $spacing_settings['mobile_content_top'] ) . 'px');
            $css->add_property( '--gutter-bottom', absint( $spacing_settings['mobile_content_bottom'] ) . 'px');
            // Background-color
            $css->add_property( '--background-color', esc_attr( $generate_settings['background_color'] ) );
            $css->add_property( '--content-color', esc_attr( $color_settings['content_background_color'] ) );
        $css->start_media_query( $media_query_min_width_desktop );
            $css->set_selector( ':root' );
                $css->add_property( '--gutter-left', absint( $spacing_settings['content_left'] ) . 'px');
                $css->add_property( '--gutter-right', absint( $spacing_settings['content_right'] ) . 'px');
                $css->add_property( '--gutter-top', absint( $spacing_settings['content_top'] ) . 'px');
                $css->add_property( '--gutter-bottom', absint( $spacing_settings['content_bottom'] ) . 'px');
        $css->stop_media_query();

        /*
         * GLOBAL SETTINGS
         */ 

        // Colors
        if ( function_exists( 'wtp_theme_colors' ) ) {
            $theme_colors = wtp_theme_colors();
            $css->set_selector( ':root' );
                foreach ($theme_colors as $key => $value) {
                    $css->add_property( '--' . $value['slug'], $value['color'] );
                }

            foreach ($theme_colors as $key => $value) {
                $css->set_selector( '.has-' . $value['slug'] . '-background-color' );
                    $css->add_property( 'background-color', $value['color']);
                $css->set_selector( '.has-' . $value['slug'] . '-color' );
                    $css->add_property( 'color', $value['color']);
            }
        }

        // Spacing
        
        // padding
        $css->set_selector( '.padding-left' );
            $css->add_property( 'padding-left', absint( $spacing_settings['mobile_content_left'] ) . 'px');
        $css->set_selector( '.padding-right' );
            $css->add_property( 'padding-right', absint( $spacing_settings['mobile_content_right'] ) . 'px');
        $css->set_selector( '.padding-top' );
            $css->add_property( 'padding-top', absint( $spacing_settings['mobile_content_top'] ) . 'px');
        $css->set_selector( '.padding-bottom' );
            $css->add_property( 'padding-bottom', absint( $spacing_settings['mobile_content_bottom'] ) . 'px');

        // margin
        $css->set_selector( '.margin-left' );
            $css->add_property( 'margin-left', absint( $spacing_settings['mobile_content_left'] ) . 'px');
        $css->set_selector( '.margin-right' );
            $css->add_property( 'margin-right', absint( $spacing_settings['mobile_content_right'] ) . 'px');
        $css->set_selector( '.margin-top' );
            $css->add_property( 'margin-top', absint( $spacing_settings['mobile_content_top'] ) . 'px');
        $css->set_selector( '.margin-bottom' );
            $css->add_property( 'margin-bottom', absint( $spacing_settings['mobile_content_bottom'] ) . 'px');


        $css->start_media_query( $media_query_min_width_desktop );
            // padding
            $css->set_selector( '.padding-left' );
                $css->add_property( 'padding-left', absint( $spacing_settings['content_left'] ) . 'px');
            $css->set_selector( '.padding-right' );
                $css->add_property( 'padding-right', absint( $spacing_settings['content_right'] ) . 'px');
            $css->set_selector( '.padding-top' );
                $css->add_property( 'padding-top', absint( $spacing_settings['content_top'] ) . 'px');
            $css->set_selector( '.padding-bottom' );
                $css->add_property( 'padding-bottom', absint( $spacing_settings['content_bottom'] ) . 'px');

            // margin
            $css->set_selector( '.margin-left' );
                $css->add_property( 'margin-left', absint( $spacing_settings['content_left'] ) . 'px');
            $css->set_selector( '.margin-right' );
                $css->add_property( 'margin-right', absint( $spacing_settings['content_right'] ) . 'px');
            $css->set_selector( '.margin-top' );
                $css->add_property( 'margin-top', absint( $spacing_settings['content_top'] ) . 'px');
            $css->set_selector( '.margin-bottom' );
                $css->add_property( 'margin-bottom', absint( $spacing_settings['content_bottom'] ) . 'px');
        $css->stop_media_query();


        /*
         * LAYOUT FIXES
         */ 

        // Main Nav Padding align to text
        $css->set_selector( '.navigation-branding');
            $css->add_property( 'margin-left', '0 !important ');

		if ( 'text' === generate_get_option( 'container_alignment' ) ) {
			$css->set_selector( '.main-navigation .inside-navigation, .site-footer .inside-site-info' );
                $css->add_property( 'padding-left', absint( $spacing_settings['mobile_content_left'] ) . 'px');
                $css->add_property( 'padding-right', absint( $spacing_settings['mobile_content_right'] ) . 'px');
            $css->start_media_query( $media_query_min_width_desktop );
                $css->set_selector( '.main-navigation .inside-navigation, .site-footer .inside-site-info' );
                    $css->add_property( 'padding-left', absint( $spacing_settings['content_left'] ) . 'px');
                    $css->add_property( 'padding-right', absint( $spacing_settings['content_right'] ) . 'px');
            $css->stop_media_query();
        }

        // main nav max-width
        $css->set_selector( '.main-navigation .inside-navigation.grid-container, .site-footer .inside-site-info.grid-container');
            $css->add_property( 'max-width', $width_with_padding);

        // main nav + footer fix

        $css->set_selector( '.main-navigation .inside-navigation.grid-container, .site-footer .inside-site-info.grid-container');
            $css->add_property( 'padding-left', absint( $spacing_settings['mobile_content_left'] ) . 'px');
            $css->add_property( 'padding-right', absint( $spacing_settings['mobile_content_right'] ) . 'px');
        $css->start_media_query( $media_query_min_width_desktop );
            $css->set_selector( '.main-navigation .inside-navigation.grid-container, .site-footer .inside-site-info.grid-container');
                $css->add_property( 'padding-left', absint( $spacing_settings['content_left'] ) . 'px');
                $css->add_property( 'padding-right', absint( $spacing_settings['content_right'] ) . 'px');
        $css->stop_media_query();

        // alignfull fix
        $css->set_selector( '.no-sidebar .entry-content .alignfull' );
            $css->add_property( 'margin-left', '-' . absint( $spacing_settings['mobile_content_left'] ) . 'px');
            $css->add_property( 'margin-right', '-' . absint( $spacing_settings['mobile_content_right'] ) . 'px');
            $css->add_property( 'max-width', 'initial');
            $css->add_property( 'width', 'initial');
        $css->start_media_query( $media_query_min_width_desktop );
            // alignfull fix
            $css->set_selector( '.no-sidebar .entry-content .alignfull' );
                $css->add_property( 'margin-left', '-' . absint( $spacing_settings['content_left'] ) . 'px' );
                $css->add_property( 'margin-right', '-' . absint( $spacing_settings['content_right'] ) . 'px' );
        $css->stop_media_query();

        $css->start_media_query( $media_query_min_width_container );
            $css->set_selector( '.no-sidebar' );
                $css->add_property( 'overflow-x', 'hidden' );
            $css->set_selector( '.no-sidebar .entry-content .alignfull' );
                $css->add_property( 'margin-left', 'calc(-50vw + 50%)' );
                $css->add_property( 'margin-right', 'calc(-50vw + 50%)' );
                $css->add_property( 'max-width', 'initial' );
                $css->add_property( 'width', 'initial' );
        $css->stop_media_query();

  

        // GROUP
        // just because I group something, doesn't mean I want a padding around it
        $css->set_selector( '.wp-block-group__inner-container');
            $css->add_property( 'padding', 'initial');
        




		return apply_filters( 'wtp_base_css_output', $css->css_output() );
	}
}

/*
 * Apply as Inline CSS in Editor
 */
add_action( 'enqueue_block_editor_assets', function() {
    wp_add_inline_style( 'generate-block-editor-styles', wtp_base_css() );
}, 100 );

/*
 * Apply as Inline CSS in Frontend
 */
add_action( 'wp_enqueue_scripts', function() {
    wp_add_inline_style( 'generate-style', wtp_base_css() );
}, 100 );