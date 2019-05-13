<?php
/**
 * Template name: Dumb latest posts
 */

$the_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5

));

$arr = '[';
$arr_end = ']';
$num = 0;
if($the_query->have_posts()):
    while($the_query->have_posts()):$the_query->the_post();
        $num+=1;
        $post_data = get_post_meta($post->ID);
        if($num < $the_query->post_count) {
            $single_arr_end = ',';
        }else {
            $single_arr_end = '';
        }
        $arr.='[{"post_title":"'.$post->post_title.'"},{"post_content":"'.substr(str_replace('"', "'", strip_tags($post->post_content)), 0, 50).'"},{"thumb":"'.get_the_post_thumbnail_url($post->ID).'"},{"link":"'.get_permalink($post->ID).'"},{"date":'.strtotime($post->post_date).'}]'.$single_arr_end;
    endwhile;
endif;
echo $arr.$arr_end;
die();