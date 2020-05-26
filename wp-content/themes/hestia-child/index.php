<?php
get_header();
?>
<div class="<?php echo esc_attr( $class_to_add ); ?> homepage-container ">
    <div class="custom-padding">
        <div class="row border-bottom">
            <?php
                $featured_posts_arr = get_posts(
                    array(
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'extra-category',
                                'field' => 'slug',
                                'terms' => 'featured'
                            )
                        )
                    )
                );
                if(!empty($featured_posts_arr)) {
                    ?>
                    <div class="col-xs-12 featured-slider no-gutter-xs">
                        <?php
                        foreach($featured_posts_arr as $post)  {
                            $post_data = get_post_meta($post->ID);
                            ?>
                            <div class="single-slide">
                                <a href="<?php echo get_permalink($post); ?>">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                        <?php
                                        if(!empty($post_data['dcn_single_page_image'][0])) {
                                            ?>
                                                <img data-defer-src="<?php echo $post_data['dcn_single_page_image'][0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true); ?>" itemprop="contentUrl"/>
                                            <?php
                                        } else if(!empty(get_the_post_thumbnail_url())) {
                                            ?>
                                            <img data-defer-src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true); ?>" itemprop="contentUrl"/>
                                            <?php
                                        }
                                        ?>
                                    </figure>
                                    <div class="content">
                                        <div class="wrapper">
                                            <div class="inner-wrapper">
                                                <time><?php echo date('M d, Y', strtotime($post->post_date)); ?></time>
                                                <div class="title"><?php echo $post->post_title; ?></div>
                                                <div class="description-text"><?php
                                                    echo substr(strip_shortcodes(strip_tags($post->post_content)), 0, 300);
                                                    ?>...</div>
                                                <div class="btn-container">
                                                    Continue Reading >>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
        </div>
    </div>
    <div class="custom-border with-row-effect only-mobile"></div>
    <div class="custom-padding">
        <div class="row">
                    <?php
                }
                require_once(get_stylesheet_directory() . '/partials/most-popular-posts.php');
            ?>
        </div>
    </div>
    <div class="custom-border with-row-effect with-top-bottom-margin"></div>
    <?php require_once(get_stylesheet_directory() . '/partials/listing-posts.php'); ?>
</div>
<?php
get_footer();
?>