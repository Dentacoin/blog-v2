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
    <?php
}
?>
</body>
</html>
