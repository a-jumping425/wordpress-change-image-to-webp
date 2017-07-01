<?php
/**
 * Add <picture> to <img> for webp
 */
include_once('simple_html_dom.php');

add_filter( 'the_content', 'add_picture_tag_to_content' );
function add_picture_tag_to_content($content) {
    // Check browser
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'OPR/') !== false || strpos($user_agent, 'Chrome/') !== false) {    // Chrome or Opera
    	
    }

    return $content;
}
