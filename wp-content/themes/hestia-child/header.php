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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-97167262-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        <?php if (empty($_COOKIE['performance_cookies'])) {
            ?>
                gtag('config', 'UA-97167262-2', {'anonymize_ip': true});
            <?php
        } else {
            ?>
                gtag('config', 'UA-97167262-2');
            <?php
        }
        ?>
    </script>
</head>

<body <?php body_class(); ?>>
<div class="mobile-nav">
    <div class="close-btn">
        <a href="javascript:void(0)">
            <img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/close-mobile-nav.svg" alt="Close mobile nav button icon"/>
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
            <!--<div class="mailchimp-form">
                <div id="mc_embed_signup">
                    <div class="title">SUBSCRIBE TO OUR LIST</div>
                    <form action="https://dentacoin.us16.list-manage.com/subscribe/post?u=61ace7d2b009198ca373cb213&amp;id=993df5967d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                        <div id="mc_embed_signup_scroll">
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                            <div class="fs-0 checkbox-container">
                                <div class="inline-block-top checkbox-wrapper">
                                    <input type="checkbox" id="consent" name="consent" required>
                                </div>
                                <label for="consent" class="privacy-policy-text inline-block-top"><span>By subscribing to our newsletter, you agree to <a href="//dentacoin.com/privacy-policy" target="_blank">our Privacy Policy</a></span></label>
                            </div>
                            <div class="form-row btn-container">
                                <input type="hidden" name="b_61ace7d2b009198ca373cb213_993df5967d" tabindex="-1" value="">
                                <div class="clear btn-container"><input type="submit" value="SUBSCRIBE" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="email-octopus-form-wrapper">
                    <p class="email-octopus-success-message"></p>
                    <p class="email-octopus-error-message"></p>
                    <form method="post" action="https://emailoctopus.com/lists/398a309b-ef00-11e8-a3c9-06b79b628af2/members/embedded/1.3s/add" class="email-octopus-form" data-sitekey="6LdYsmsUAAAAAPXVTt-ovRsPIJ_IVhvYBBhGvRV6" data-success-message="Thank you for signing up!">
                        <div class="title">SUBSCRIBE TO OUR LIST</div>
                        <div class="form-row fs-0 flex email-octopus-form-row" data-valid-email-message="Please enter valid email.">
                            <input id="field_0" name="field_0" type="email" placeholder="Email address">
                            <input type="hidden" name="successRedirectUrl" value="">
                        </div>
                        <div class="email-octopus-form-row-consent form-row fs-0">
                            <div class="inline-block-top checkbox-wrapper">
                                <input type="checkbox" id="consent" name="consent">
                            </div>
                            <label for="consent" class="privacy-policy-text inline-block-top"><span> As per your request, we will use the data provided to send you newsletters. You can change your mind any time by clicking the unsubscribe link in the footer of any marketing email your receive from us. By clicking on the SIGN UP button, you agree to our <a href="//dentacoin.com/privacy-policy">Privacy Policy</a></span></label>
                        </div>
                        <div class="form-row btn-container">
                            <button type="submit">SIGN UP</button>
                        </div>
                        <div class="email-octopus-form-row-hp" aria-hidden="true">
                            <input type="text" name="hp398a309b-ef00-11e8-a3c9-06b79b628af2" tabindex="-1" autocomplete="nope"/>
                        </div>
                    </form>
                </div>
            </div>-->
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
        <header class="custom-padding <?php
        if(is_single()) { ?> single <?php }?>">
            <div class="row fs-0">
                <?php
                if(is_single()) {
                    ?>
                    <a href="<?php echo site_url(''); ?>" class="col-md-2 col-lg-1 inline-block go-back">< back</a>
                    <?php
                }
                ?>
                <nav class="col-xs-4 <?php
                if(is_single()) { ?> col-md-7 col-lg-8 <?php }else { ?> col-md-9 <?php } ?> inline-block header-menu no-gutter">
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
                    <?php
                        if(is_single()) {
                            $url = get_permalink($post->ID);
                        }else {
                            $url = site_url();
                        }
                    ?>
                    <ul itemscope="" itemtype="http://schema.org/Organization">
                        <link itemprop="url" href="<?php echo site_url(); ?>">
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block"><a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $url; ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li itemprop="sameAs" class="inline-block search">
                            <?php get_search_form(); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="custom-border with-row-effect"></div>
        <main>

