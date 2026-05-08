<?php
wp_enqueue_style('cta-block', get_stylesheet_directory_uri() . '/tpl-acf-blocks/cta-block/block-cta.css', null, null);

$part_args = !empty($args) ? $args : array();
$block =  get_field( 'cta_block' ) ? get_field( 'cta_block' ) : $part_args['block'] ; ?>

    </div>
</div>

<section class="container">
    <div class="cta_block content">
        <div class="cta_block__content">
            <?php if ( $subtitle = $block['subtitle'] ) : ?>
                <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ( $title = $block['title'] ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>

            <?php if ( $description = $block['description'] ) : ?>
                <div class="cta_block__description content">
                    <?php echo wp_kses_post( $description ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $button = $block['button'] ) : ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>" class="cta_block__button is_outline_button" target="<?php echo $button['target'] ? : '_self'; ?>">
                    <?php echo esc_html( $button['title'] ); ?>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 9H14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 3.75L14.25 9L9 14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="container">
    <div class="content">
