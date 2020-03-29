<?php
/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '<p></p>', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '<p></p>', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);