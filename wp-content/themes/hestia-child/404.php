<?php
get_header();
$query_images_args = array(
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => - 1,
);

$query_images = new WP_Query( $query_images_args );
var_dump($query_images->posts);

/*$images = array();
foreach ( $query_images->posts as $image ) {
    $images[] = wp_get_attachment_url( $image->ID );
}*/
?>
    <div class="container-404">
        <figure class="logo" itemscope="" itemtype="http://schema.org/ImageObject">
            <a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>-child/assets/images/404-page.svg" alt="404 page" itemprop="contentUrl"/></a>
        </figure>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="ops">Oops! We couldn't find this page.</div>
                    <div class="homepage-link"><a href="<?php echo site_url(''); ?>">BACK TO HOME</a></div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
?>