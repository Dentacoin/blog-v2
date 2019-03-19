<?php
get_header();
?>
    <div class="<?php echo esc_attr( $class_to_add ); ?> category-container">
        <h1 class="page-title"><span><?php echo get_the_category()[0]->name; ?></span></h1>
        <?php require_once(get_stylesheet_directory() . '/partials/listing-posts.php'); ?>
    </div>
<?php
get_footer();
?>