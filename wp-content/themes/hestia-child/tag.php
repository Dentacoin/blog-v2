<?php
get_header();
?>
    <div class="<?php echo esc_attr( $class_to_add ); ?> tags-container">
        <h1 class="page-title">Tag <span><?php echo get_queried_object()->name; ?></span></h1>
        <?php require_once(get_stylesheet_directory() . '/partials/listing-posts.php'); ?>
    </div>
<?php
get_footer();
?>