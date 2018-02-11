<section id="contact">
    <?php if (is_front_page()) : ?>
        <div id="map">
            <div id="gmap-wrap">
                <div id="gmap">
                </div>
            </div>
        </div><!--/#map-->
    <?php endif; ?>
    <div class="contact-section">
        <div class="ear-piece">
            <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ear-piece.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-4">
                    <div class="contact-text">
                        <h3>Contact</h3>
                        <address>
                            E-mail: contact@evento.com<br>
                            Tél : 01 23 45 67 89<br>
                            Fax : 01 23 45 67 88
                        </address>
                    </div>
                    <div class="contact-address">
                        <h3>Situation</h3>
                        <address>
                            23 Avenue Albert Einstein,<br>
                            17000 La Rochelle<br>
                            France
                        </address>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div id="contact-section">
                        <h3>Envoyer un message</h3>
                        <div class="status alert alert-success" style="display: none"></div>
                        <?php echo do_shortcode('[contact-form-7 id="14" title="Formulaire de contact 1"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#contact-->

<footer id="footer">
    <div class="container">
        <div class="collapse navbar-collapse">
            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'nav navbar-nav')); ?>
        </div>
    </div>
</footer>
<!--/#footer-->


<?php wp_footer(); ?>
</body>
</html>
