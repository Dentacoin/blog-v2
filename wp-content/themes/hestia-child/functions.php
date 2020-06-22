<?php

//===============================STYLES AND SCRIPTS=================================================
require_once(get_stylesheet_directory() . '/includes/styles-and-scripts.php');


function dcn_add_menu()  {
    register_nav_menu('extra-footer', 'Extra Footer Navigation');
    register_nav_menu('mobile-header-nav', 'Mobile header nav');
}
add_action('init', 'dcn_add_menu');

function dcn_custom_widget_setup() {
    register_sidebar(
        array(
            'name' => 'Custom widget',
            'id' => 'dcn-custom-widget',
            'class' => 'dcn-custom-widget',
            'description' => 'Standard Sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>'
        )
    );
}
add_action('widgets_init', 'dcn_custom_widget_setup');

//transliterating cyrillic to latin letters
function dcn_transliterate($str)    {
    return str_replace(array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
        'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
        'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
        'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' '), array('a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
        'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
        'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
        'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya', '-'), $str);
}


function hestia_comments_template() {
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $args     = array(
        'class_form'         => 'form',
        'class_submit'       => 'btn btn-primary pull-right',
        'title_reply_before' => '<h3 class="hestia-title text-center">',
        'title_reply_after'  => '</h3><div class="media-body">',
        'must_log_in'        => '<p class="must-log-in">' .
            sprintf(
                wp_kses(
                /* translators: %s is Link to login */
                    __( 'You must be <a href="%s">logged in</a> to post a comment.', 'hestia-child' ), array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) )
            ) . '</p> </div>',
        'fields'             => apply_filters(
            'comment_form_default_fields', array(
                'author' => '<div class="row"> <div class="col-md-4"> <div class="form-group label-floating is-empty"><input id="author" name="author" class="form-control" placeholder="' . esc_html__('Name', 'hestia-child') . '" required type="text"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>',
                'email'  => '<div class="col-md-4"> <div class="form-group label-floating is-empty"><input id="email" placeholder="' . esc_html__('Email', 'hestia-child') . '" name="email" class="form-control" required type="email"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>',
                'url'    => '<div class="col-md-4"> <div class="form-group label-floating is-empty"><input id="url" name="url" placeholder="' . esc_html__('Website', 'hestia-child') . '" class="form-control" type="url"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div> </div>',
            )
        ),
        'comment_field'      => '<div class="form-group label-floating is-empty"><textarea id="comment" name="comment" placeholder="' . esc_html__('Comment', 'hestia-child') . '" class="form-control" rows="6" aria-required="true" required></textarea><span class="hestia-input"></span> </div> </div><p class="comment-notes visible-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>',
    );

    return $args;
}

function dcn_add_metabox()   {
    add_meta_box(
        'dcn_meta',
        'Single page image',
        'dcn_meta_callback',
        'post',
        'normal',
        'core'
    );
}

add_action('add_meta_boxes', "dcn_add_metabox");

function dcn_meta_callback($post) {
    wp_nonce_field( basename( __FILE__ ), 'dcn_posts_nonce' );
    wp_enqueue_media();
    $dcn_stored_meta = get_post_meta($post->ID);
    ?>
    <div style="padding-bottom: 15px;">
        <div style="padding-bottom: 10px;">Show image on single page:</div>
        <input type="radio" <?php if($dcn_stored_meta['dcn_single_page_image_bool'][0] == 'true' || $dcn_stored_meta['dcn_single_page_image_bool'][0] == NULL) { ?> checked <?php } ?> name="dcn_single_page_image_bool" value="true"> Yes
        <input type="radio" style="margin-left: 15px;" <?php if($dcn_stored_meta['dcn_single_page_image_bool'][0] == 'false') { ?> checked <?php } ?> name="dcn_single_page_image_bool" value="false"> No
    </div>
    <div>
        <input type="text" name="dcn_single_page_image" id="image_url" class="regular-text" value="<?php
            if(!empty($dcn_stored_meta['dcn_single_page_image']))   {
                echo $dcn_stored_meta['dcn_single_page_image'][0];
            }
        ?>">
        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
    </div>
    <div>
        <div style="padding-bottom: 10px;padding-top: 10px;">Vertical offset:</div>
        <input type="number" name="dcn_single_page_image_vertical_offset" class="regular-text" value="<?php
            if(!empty($dcn_stored_meta['dcn_single_page_image_vertical_offset']))   {
                echo $dcn_stored_meta['dcn_single_page_image_vertical_offset'][0];
            }
        ?>">
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#upload-btn').click(function (e) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                    .on('select', function (e) {
                        // This will return the selected image from the Media Uploader, the result is an object
                        var uploaded_image = image.state().get('selection').first();
                        // We convert uploaded_image to a JSON object to make accessing it easier
                        var image_url = uploaded_image.toJSON().url;
                        // Let's assign the url value to the input field
                        $('#image_url').val(image_url);
                    });
            });
        });
    </script>
    <?php
}

function dcn_post_save($post_id) {
    if(!empty($_POST)) {
        fixTheCountOfFeaturedAndMostPopuparPosts($_POST, $post_id);
    }
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'dcn_posts_nonce' ] ) && wp_verify_nonce( $_POST[ 'dcn_posts_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if ( isset( $_POST[ 'dcn_single_page_image' ] ) ) {
        update_post_meta( $post_id, 'dcn_single_page_image', sanitize_text_field( $_POST[ 'dcn_single_page_image' ] ) );
    }
    if ( isset( $_POST[ 'dcn_single_page_image_bool' ] ) ) {
        update_post_meta( $post_id, 'dcn_single_page_image_bool', sanitize_text_field( $_POST[ 'dcn_single_page_image_bool' ] ) );
    }
    if ( isset( $_POST[ 'dcn_single_page_image_vertical_offset' ] ) ) {
        update_post_meta( $post_id, 'dcn_single_page_image_vertical_offset', sanitize_text_field( $_POST[ 'dcn_single_page_image_vertical_offset' ] ) );
    }
}
add_action('save_post', 'dcn_post_save');

//Stops the WP api requests for retrieving the users data
add_filter('rest_endpoints', function($endpoints){
    if (isset( $endpoints['/wp/v2/users'])) {
        unset( $endpoints['/wp/v2/users']);
    }
    if (isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

//removing wordpress version from wp_head
remove_action('wp_head', 'wp_generator');

function dcn_sample_page_rewrite_rule() {
    $pagePath = parse_url( $_SERVER['REQUEST_URI'] );
    $pagePath = $pagePath['path'];
    $pagePath = substr($pagePath, 1, -1);
    if($pagePath == 'sample-page') {
        wp_redirect(site_url());
        exit();
    }
}
add_action('init', 'dcn_sample_page_rewrite_rule' );

function dcn_post_edit($post_id) {
    if(!empty($_POST)) {
        fixTheCountOfFeaturedAndMostPopuparPosts($_POST, $post_id);
    }
}

function fixTheCountOfFeaturedAndMostPopuparPosts($post_data, $post_id) {
    if(!empty($post_data['tax_input']) && is_admin()) {
        if(!empty($post_data['tax_input']['extra-category'])) {
            $terms = get_terms('extra-category', array(
                'hide_empty' => false,
            ));
            global $post;
            foreach($terms as $term) {
                $the_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'extra-category',
                            'field' => 'slug',
                            'terms' => $term->slug
                        )
                    )

                ));

                if($term->slug == 'featured' && $the_query->post_count > 5) {
                    $counter = 0;
                    if($the_query->have_posts()) :
                        while($the_query->have_posts()) : $the_query->the_post();
                            if($counter >= 5) {
                                //update
                                $array_with_terms_id_to_save = array();
                                $this_post_terms = wp_get_post_terms($post->ID, 'extra-category');
                                if(!empty($this_post_terms) && is_array($this_post_terms)) {
                                    foreach($this_post_terms as $key => $this_post_term) {
                                        if($this_post_term->slug == 'featured') {
                                            unset($this_post_terms[$key]);
                                        } else {
                                            array_push($array_with_terms_id_to_save, $this_post_term->term_id);
                                        }
                                    }
                                }
                                wp_set_post_terms($post->ID, $array_with_terms_id_to_save, 'extra-category');
                            }
                            $counter+=1;
                        endwhile;
                    endif;
                }

                if($term->slug == 'most-popular' && $the_query->post_count > 10) {
                    $counter = 0;
                    if($the_query->have_posts()) :
                        while($the_query->have_posts()) : $the_query->the_post();
                            if($counter >= 10) {
                                //update
                                $array_with_terms_id_to_save = array();
                                $this_post_terms = wp_get_post_terms($post->ID, 'extra-category');
                                if(!empty($this_post_terms) && is_array($this_post_terms)) {
                                    foreach($this_post_terms as $key => $this_post_term) {
                                        if($this_post_term->slug == 'most-popular') {
                                            unset($this_post_terms[$key]);
                                        } else {
                                            array_push($array_with_terms_id_to_save, $this_post_term->term_id);
                                        }
                                    }
                                }
                                wp_set_post_terms($post->ID, $array_with_terms_id_to_save, 'extra-category');
                            }
                            $counter+=1;
                        endwhile;
                    endif;
                }

                wp_reset_query();
            }
        }
    }
}
add_action('edit_post', 'dcn_post_edit');

// on media saving to db automatically generate alt text from the title
function dcn_image_meta_upon_image_upload($post_ID) {
    if (wp_attachment_is_image($post_ID)) {
        $my_image_title = get_post($post_ID)->post_title;
        update_post_meta( $post_ID, '_wp_attachment_image_alt', ucfirst(str_replace('-', ' ', dcn_transliterate($my_image_title))));
    }
}
add_action('add_attachment', 'dcn_image_meta_upon_image_upload');

function disable_comment_url($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','disable_comment_url');