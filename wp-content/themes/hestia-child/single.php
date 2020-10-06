<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();
$curr_post = $post;
$post_data = get_post_meta($curr_post->ID);
?>

<div class="single-post-container">
    <?php
    if($post_data['dcn_single_page_image_bool'][0] == 'true') {
        if(!empty($post_data['dcn_single_page_image'][0])) {
            ?>
            <figure class="row post-thumb" itemscope="" itemtype="http://schema.org/ImageObject">
                <img data-defer-src="<?php echo $post_data['dcn_single_page_image'][0]; ?>" style="<?php if(!empty($post_data['dcn_single_page_image_vertical_offset'][0])) { ?> top: <?php echo $post_data['dcn_single_page_image_vertical_offset'][0]; ?>%; <?php } ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true); ?>" itemprop="contentUrl"/>
            </figure>
            <?php
        }else if(get_the_post_thumbnail_url())    {
            ?>
            <figure class="row post-thumb" itemscope="" itemtype="http://schema.org/ImageObject">
                <img data-defer-src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true); ?>" itemprop="contentUrl"/>
            </figure>
            <?php
        }
    }
    ?>
    <div class="custom-padding content-container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1 next-to-socials">
                <h1 class="title"><?php echo $post->post_title; ?></h1>
                <div class="author">Published by <a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta( 'display_name', $post->post_author ); ?></a> on <time><?php echo date('M d, Y', strtotime($post->post_date)); ?></time></div>
                <div class="description">
                    <?php
                    while(have_posts()):the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
                <div class="socials">
                    <?php dynamic_sidebar('custom-widget'); ?>
                </div>
                <div class="categories">
                    <span class="cats-title">
                        <?php _e('Categories:', 'hestia-child'); ?>
                    </span>
                    <?php
                    $categories = get_the_category( $post->ID );
                    foreach ( $categories as $category ) {
                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
                    }
                    ?>
                </div>
                <div class="tags">
                    <span class="tags-title"><?php _e( 'Tags:', 'hestia-child' ); ?></span>
                    <?php the_tags('<span class="entry-tag">', '</span><span class="entry-tag">', '</span>'); ?>
                </div>
            </div>
        </div>
        <div class="row row-just-for-border"></div>
    </div>
    <div class="custom-padding slider">
        <div class="row">
            <?php require_once(get_stylesheet_directory() . '/partials/most-popular-posts.php'); ?>
        </div>
    </div>
    <div class="custom-border with-row-effect"></div>
    <div class="custom-padding">
        <div class="row comments-form">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 no-gutter-xs">
                <?php
                $author_description = get_the_author_meta('description');
                if(!empty( $author_description)) :
                    hestia_author_box();
                endif;
                if(comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo get_permalink($post); ?>"
  },
  "headline": "<?php echo $post->post_title; ?>",
  "description": "<?php substr($post->post_content, 0, 130); ?>...",
    <?php
    $imageUrl = get_the_post_thumbnail_url($post->ID);
    if (!empty($imageUrl)) {
        list($width, $height) = getimagesize($imageUrl);
        ?>
              "image": {
                "@type": "ImageObject",
                "url": "<?php echo $imageUrl; ?>",
                "width": "<?php echo $width; ?>",
                "height": "<?php echo $height; ?>"
                },
            <?php
    }
    ?>
  "author": {
    "@type": "Person",
    "name": "<?php echo get_the_author(); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Dentacoin Blog",
    "logo": {
      "@type": "ImageObject",
      "url": "https://blog.dentacoin.com/wp-content/themes/hestia-child/assets/images/one-line-logo-black.png",
      "width": "2018",
      "height": "442"
    }
  },
  "datePublished": "<?php echo $post->post_date; ?>"
}
</script>