<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the page header div.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset='<?php bloginfo( 'charset' ); ?>'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="mobile-nav">
    <div class="close-btn">
        <a href="javascript:void(0)">
            <img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/close-mobile-nav.svg"/>
        </a>
    </div>
    <nav>
        <?php
        wp_nav_menu(array('theme_location'  => 'mobile-header-nav'));
        ?>
    </nav>
</div>
<div
    <?php
    if ( ! is_single() ) {
        echo 'class="wrapper"';
    } else {
        post_class( 'wrapper' );
    }

    $header_class = '';
    $hide_top_bar = get_theme_mod( 'hestia_top_bar_hide', true );
    if ( (bool) $hide_top_bar === false ) {
        $header_class .= 'header-with-topbar';
    }
    ?>
>
    <aside class="main-sidebar fs-0">
        <div class="wrapper inline-block">
            <figure class="logo" itemscope="" itemtype="http://schema.org/ImageObject">
                <a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/blog-logo.svg" alt="Dentacoin blog logo" itemprop="contentUrl"/></a>
            </figure>
            <figure class="pictograms" itemscope="" itemtype="http://schema.org/ImageObject">
                <img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/pictograms.svg" alt="Pictorgams" itemprop="contentUrl"/>
            </figure>
            <div class="mailchimp-form">
                <?php echo do_shortcode('[mc4wp_form id="161"]'); ?>
            </div>
            <div class="apps-nav">
                <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                    <li><a itemprop="url" href="https://dentacoin.com/" target="_blank"><span itemprop="name">Dentacoin</span></a></li>
                    <li>|</li>
                    <li><a itemprop="url" href="https://dentacare.dentacoin.com/" target="_blank"><span itemprop="name">Dentacare</span></a></li>
                    <li>|</li>
                    <li><a itemprop="url" href="https://reviews.dentacoin.com/" target="_blank"><span itemprop="name">Trusted Reviews</span></a></li>
                    <li>|</li>
                    <li><a itemprop="url" href="https://dentavox.dentacoin.com/" target="_blank"><span itemprop="name">DentaVox</span></a></li>
                </ul>
            </div>
        </div>
        <figure class="close inline-block" itemscope="" itemtype="http://schema.org/ImageObject">
            <a href="javascript:void(0)" data-open="true"><img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/close-arrow.svg" data-open-arrow="<?php echo get_template_directory_uri(); ?>-child/assets/images/open-arrow.svg" data-close-arrow="<?php echo get_template_directory_uri(); ?>-child/assets/images/close-arrow.svg" alt="Sidebar toggle button" itemprop="contentUrl"/></a>
        </figure>
    </aside>
    <div class="container-fluid main-wrapper moved">
        <header class="custom-padding">
            <div class="row fs-0">
                <nav class="col-xs-4 col-md-9 inline-block header-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container'       => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => 'main-navigation',
                            'menu_class'      => 'nav navbar-nav navbar-right',
                            'fallback_cb'     => 'hestia_bootstrap_navwalker::fallback',
                            'walker'          => new hestia_bootstrap_navwalker(),
                            'items_wrap'      => ( function_exists( 'hestia_after_primary_navigation' ) ) ? hestia_after_primary_navigation() : '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        )
                    );
                    ?>
                </nav>
                <div class="mobile-nav-container inline-block col-xs-4">
                    <a href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>
                </div>
                <nav class="col-xs-8 col-md-3 inline-block socials">
                    <ul itemscope="" itemtype="http://schema.org/Organization">
                        <link itemprop="url" href="<?php echo site_url(); ?>">
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo site_url(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?php echo site_url(); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block search">
                            <?php get_search_form(); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="custom-border with-row-effect"></div>
        <main>

