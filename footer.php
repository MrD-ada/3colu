<footer id="colophon" class="site-footer">
    <div class="footer-inner">
        <div class="footer-content">
            <div class="footer-branding">
                <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                <?php endif; ?>
            </div>
            <?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar( 'footer-widget' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="site-info">
            Copyright © 2023. All rights reserved.
        </div>
    </div>
</footer></div><?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
</body>
</html>