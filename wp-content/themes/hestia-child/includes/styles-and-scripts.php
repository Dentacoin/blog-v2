<?php

function dcn_add_styles_and_scripts() {
    wp_enqueue_style('slick-style',get_template_directory_uri() . '-child/assets/libs/slick/slick.css', array(), '1.0.0', 'all');

    wp_enqueue_style('emailoctopus-style',get_template_directory_uri() . '-child/assets/libs/emailoctopus/emailoctopus.css', array(), '1.0.0', 'all');

    wp_enqueue_script('slick-script', get_template_directory_uri() . '-child/assets/libs/slick/slick.js', array( 'jquery' ) );

    wp_enqueue_script('emailoctopus-script', get_template_directory_uri() . '-child/assets/libs/emailoctopus/emailoctopus.js', array( 'jquery' ) );

    wp_enqueue_style('custom_style', get_template_directory_uri() . '-child/assets/css/style.css', array(), '1.0.9', 'all' );

    wp_enqueue_script('basic_custom_script', get_template_directory_uri() . '-child/assets/js/basic.js', array(), '1.0.9', true);

    wp_enqueue_script('custom_script', get_template_directory_uri() . '-child/assets/js/index.js', array(), '1.0.9', true);

    if(empty($_COOKIE['performance_cookies']) && empty($_COOKIE['functionality_cookies']) && empty($_COOKIE['marketing_cookies']) && empty($_COOKIE['strictly_necessary_policy'])) {
        wp_enqueue_style('combined_cookie_style', 'https://dentacoin.com/assets/libs/dentacoin-package/css/style-cookie.css', array(), time(), 'all' );

        wp_enqueue_script('combined_cookie_script', 'https://dentacoin.com/assets/libs/dentacoin-package/js/init.js', array(), time(), true);
    }
}
add_action('wp_enqueue_scripts', 'dcn_add_styles_and_scripts');
