<?php
get_header();
?>
<div class="<?php echo esc_attr( $class_to_add ); ?> homepage-container ">
    <div class="custom-padding">
        <div class="row">
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
                            ?>
                            <div class="single-slide">
                                <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" itemprop="contentUrl"/>
                                </figure>
                                <div class="content">
                                    <div class="wrapper">
                                        <div class="inner-wrapper">
                                            <time><?php echo date('M d, Y', strtotime($post->post_date)); ?></time>
                                            <div class="title"><?php echo $post->post_title; ?></div>
                                            <div class="description-text"><?php
                                                echo substr(strip_tags($post->post_content), 0, 300);
                                                ?>...</div>
                                            <div class="btn-container">
                                                <a href="<?php echo get_permalink($post); ?>">Continue Reading >></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
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