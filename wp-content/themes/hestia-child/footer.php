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
<?php wp_footer(); ?>
</body>
</html>
