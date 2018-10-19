<?php
$first_roll = true;
if(have_posts()) :
    ?>
    <div class="listing-posts-module">
        <?php
        while(have_posts()):
            the_post();
            if(!$first_roll) {
                $first_roll = false;
                ?>
                <div class="custom-border with-row-effect"></div>
                <?php
            }
            ?>
            <div class="custom-padding">
                <div class="row list-with-posts">
                    <div class="col-xs-12 col-sm-offset-2 col-sm-8 no-gutter-xs single-post-in-list">
                        <div class="post-title">
                            <a href="<?php echo get_permalink($post); ?>"><?php echo $post->post_title; ?></a>
                        </div>
                        <div class="author">Published by <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta( 'display_name', $post->post_author ); ?></a> on <time><?php echo date('M d, Y', strtotime($post->post_date)); ?></time></div>
                        <?php
                        if(get_the_post_thumbnail_url())   {
                            ?>
                            <figure class="inline-block" itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="<?php echo get_permalink($post); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" itemprop="contentUrl"/>
                                </a>
                            </figure>
                            <?php
                        }
                        ?>
                        <div class="description-text"><?php echo substr(strip_tags($post->post_content), 0, 500); ?>...</div>
                        <div class="btn-container">
                            <a href="<?php echo get_permalink($post); ?>">Continue Reading >></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $first_roll = false;
        endwhile;
        ?>
    </div>
    <?php
    the_posts_pagination();
else :
    ?>
    <div class="no-results"><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hestia-child'); ?></div>
    <?php
endif;