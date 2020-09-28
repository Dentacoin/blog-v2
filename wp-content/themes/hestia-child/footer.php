        </main>
        <div class="row">
            <footer class="custom-padding">
                <div class="mailchimp-form">
                    <?php echo do_shortcode('[mc4wp_form id="161"]'); ?>
                </div>
                <nav>
                    <?php
                    wp_nav_menu(array('theme_location' => 'extra-footer'));
                    ?>
                </nav>
            </footer>
        </div>
    </div>
</div>
<?php wp_footer();
if (is_single()) {
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
        if (!empty(get_the_post_thumbnail_url($post->ID))) {
            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
            $attachment = wp_get_attachment_image_src($post_thumbnail_id);
            ?>
              "image": {
                "@type": "ImageObject",
                "url": "<?php echo get_the_post_thumbnail_url($post->ID); ?>",
                "width": "<?php echo $attachment[1]; ?>",
                "height": "<?php echo $attachment[2]; ?>"
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
      "url": "https://blog.dentacoin.com/wp-content/themes/hestia-child/assets/images/blog-logo.svg",
      "width": "178",
      "height": "32"
    }
  },
  "datePublished": "<?php echo $post->post_date; ?>"
}
</script>
    <?php
}
?>
</body>
</html>
