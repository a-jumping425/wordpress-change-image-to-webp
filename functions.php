<?php
/**
 * Add <picture> to <img> for webp
 */
include_once('simple_html_dom.php');

add_filter( 'the_content', 'add_picture_tag_to_content' );
function add_picture_tag_to_content($content) {
    return $content;
}
