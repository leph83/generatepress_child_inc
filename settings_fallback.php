<?php 

if ( !function_exists('wtp_font') ) {
    function wtp_font() {
        return 'Montserrat, Karla';
    }
}


if ( !function_exists('wtp_font') ) {
    function wtp_test() {
        return false;
    }
}

if ( !function_exists('wtp_version') ) {
    function wtp_version() {
        return '2020-03-24';
    }
}

/**
 * Custom Modifier
 */

if ( !function_exists('wtp_additional_class_modifier') ) {
    function wtp_additional_class_modifier() {
        return 'wtp';
    }
}

/**
 * Define Theme Colors for Gutenberg and GeneratePress
 */

if ( !function_exists('wtp_theme_colors') ) {
    function wtp_theme_colors() {
        $theme_colors = array(
            array(
                'name' => __( 'transparent', 'generate' ),
                'slug' => 'color-transparent',
                'color' => 'transparent',
            ),
            array(
                'name' => __( 'black', 'generate' ),
                'slug' => 'color-black',
                'color' => '#000000',
            ),
            array(
                'name' => __( 'white', 'generate' ),
                'slug' => 'color-white',
                'color' => '#ffffff',
            ),
            array(
                'name' => __( 'primary', 'generate' ),
                'slug' => 'color-1',
                'color' => '#f19225',
            ),
            array(
                'name' => __( 'secondary', 'generate' ),
                'slug' => 'color-2',
                'color' => '#1178ac',
            ),
            array(
                'name' => __( 'tertiary', 'generate' ),
                'slug' => 'color-3',
                'color' => '#211826',
            ),
            array(
                'name' => __( 'buhu', 'generate' ),
                'slug' => 'color-4',
                'color' => 'red',
            ),
        );

        return $theme_colors;
    }
}