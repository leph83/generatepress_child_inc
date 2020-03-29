<?php 

/**
 * Disable php edit
 */
define( 'GENERATE_HOOKS_DISALLOW_PHP', true );

// /**
//  * Disable CSS edit
//  */
define( 'DISALLOW_FILE_EDIT', true );

// /**
//  * Don't Show Version of Wordpress
//  */
remove_action('wp_head', 'wp_generator');