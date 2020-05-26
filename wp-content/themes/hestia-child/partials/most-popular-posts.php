<?php
$most_popular_posts_arr = get_posts(
    array(
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'extra-category',
                'field' => 'slug',
                'terms' => 'most-popular'
            )
        )
    )
);
if(!empty($most_popular_posts_arr)){
    ?>
    <div class="col-xs-12 no-gutter-xs slider-title"><?php _e('Most Popular', 'hestia-child'); ?></div>
    <div class="col-xs-12 no-gutter-xs most-popular-slider">
        <?php
        foreach($most_popular_posts_arr as $slide)   {
            ?>
            <a href="<?php echo get_permalink($slide); ?>">
                <div class="single-slide fs-0">
                    <figure class="inline-block" itemscope="" itemtype="http://schema.org/ImageObject">
                        <img data-defer-src="<?php echo get_the_post_thumbnail_url($slide); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($slide), '_wp_attachment_image_alt', true); ?>" itemprop="contentUrl"/>
                    </figure>
                    <div class="content inline-block">
                        <div class="title"><?php echo $slide->post_title; ?></div>
                        <time><?php echo date('M d, Y', strtotime($slide->post_date)); ?></time>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
    <?php
}