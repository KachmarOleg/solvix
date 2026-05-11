</main>

<?php
$footer = get_field('footer', 'option');

$footer_logo   = $footer['logo'];
$footer_slogan = $footer['slogan'];
$footer_email  = $footer['email'];
?>

<footer class="site_footer">
    <div class="container">
        <div class="site_footer__top">
            <div class="site_footer__left">
                <?php if ( $footer_logo ) : ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="site_footer__logo">
                        <img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ?: get_bloginfo('name') ); ?>">
                    </a>
                <?php endif; ?>

                <?php if ( $footer_slogan ) : ?>
                    <div class="site_footer__slogan">
                        <?php echo esc_html( $footer_slogan ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $footer_email ) : ?>
                    <a href="mailto:<?php echo antispambot( esc_attr( $footer_email ) ); ?>" class="site_footer__email">
                        <?php echo esc_html( $footer_email ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="site_footer__right">
                <?php wp_nav_menu([
                        'theme_location' => 'footer_menu',
                        'container'      => false,
                        'menu_class'     => 'footer_menu',
                        'fallback_cb'    => false,
                ]); ?>
            </div>

        </div>

        <div class="site_footer__bottom">
            <div class="site_footer__copy">
                © <?php echo esc_html( date('Y') ); ?> <?php bloginfo('name'); ?>.
                All rights reserved.
            </div>

            <?php wp_nav_menu([
                    'theme_location' => 'footer_bottom_menu',
                    'container'      => false,
                    'menu_class'     => 'footer_bottom_menu',
                    'fallback_cb'    => false,
            ]); ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>