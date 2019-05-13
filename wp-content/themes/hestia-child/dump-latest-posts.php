<?php
/**
 * Template name: Dumb latest posts
 */

$the_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5

));

$array = array();
if($the_query->have_posts()):
    while($the_query->have_posts()):$the_query->the_post();
        $post_data = get_post_meta($post->ID);
        $current_post_arr = array(
            "post_title" => $post->post_title,
            "post_content" => substr(str_replace('"', "'", strip_tags($post->post_content)), 0, 50),
            "thumb" => get_the_post_thumbnail_url($post->ID),
            "link" => get_permalink($post->ID),
            "date" => strtotime($post->post_date)
        );

        array_push($array, $current_post_arr);
    endwhile;
endif;
echo json_encode($array);
die();