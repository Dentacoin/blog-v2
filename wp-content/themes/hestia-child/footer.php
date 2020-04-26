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
    <?php
        if (empty($_COOKIE['performance_cookies']) && empty($_COOKIE['marketing_cookies'])) {
            ?>
            <div class="bottom-fixed-container">
                <div class="privacy-policy-cookie">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="text inline-block">This site uses cookies. Find out more on how we use cookies in our <a href="https://dentacoin.com/privacy-policy" class="link" target="_blank">Privacy Policy</a>. | <a href="javascript:void(0);" class="link adjust-cookies">Adjust cookies</a></div>
                                <div class="button-container inline-block"><a href="javascript:void(0);" class="white-blue-rounded-btn accept-all">Accept all cookies</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
</body>
</html>
