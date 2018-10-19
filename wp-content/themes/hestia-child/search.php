<?php
get_header();
?>
    <div class="<?php echo esc_attr( $class_to_add ); ?> search-container">
        <h1 class="page-title"><?php _e('Results:', 'hestia-child'); ?></h1>
        <?php require_once(get_stylesheet_directory() . '/partials/listing-posts.php'); ?>
    </div>
<?php
get_footer();
?>