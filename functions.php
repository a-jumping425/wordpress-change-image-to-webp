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
        $upload_dir = wp_upload_dir();

        $html = \simplehtmldom_1_5\str_get_html($content);
        $img_tags = $html->find('img');
        foreach($img_tags as $img_tag) {
            $src = $img_tag->src;

            // Check invalid image url
            if (strpos($src, $upload_dir['baseurl']) === false)
                contine;

            // Get image path
            $img_sub_path = substr($src, strlen($upload_dir['baseurl']));
            $img_path = $upload_dir['basedir'] . $img_sub_path;

            // Check exist webp
            if (!file_exists($img_path . '.webp'))
                continue;

            $webp_url = $upload_dir['baseurl'] . $img_sub_path . '.webp';
            $img_tag->outertext = '<picture>'
                . '<source srcset="'. $webp_url .'" type="image/webp">'
                . $img_tag->outertext
                . '</picture>';
        }

        $content = $html;
        return $content;
    }

    return $content;
}
