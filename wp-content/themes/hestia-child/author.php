<?php
get_header();
?>
    <div class="<?php echo esc_attr( $class_to_add ); ?> author-container">
        <h1 class="page-title">Author <span><?php echo get_the_author(); ?></span></h1>
        <?php require_once(get_stylesheet_directory() . '/partials/listing-posts.php'); ?>
    </div>
<?php
get_footer();
?>