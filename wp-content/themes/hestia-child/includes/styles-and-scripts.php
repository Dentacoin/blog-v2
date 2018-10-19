<?php

function dcn_add_styles_and_scripts() {
    wp_enqueue_style('slick-style',get_template_directory_uri() . '-child/assets/libs/slick/slick.css', array(), '1.0.0', 'all');

    wp_enqueue_script('slick-script', get_template_directory_uri() . '-child/assets/libs/slick/slick.js', array( 'jquery' ) );

    wp_enqueue_style('custom_style', get_template_directory_uri() . '-child/assets/css/style.css', array(), '1.0.5', 'all' );

    wp_enqueue_script('basic_custom_script', get_template_directory_uri() . '-child/assets/js/basic.js', array(), '1.0.5', true);

    wp_enqueue_script('custom_script', get_template_directory_uri() . '-child/assets/js/index.js', array(), '1.0.5', true);
}
add_action('wp_enqueue_scripts', 'dcn_add_styles_and_scripts');
