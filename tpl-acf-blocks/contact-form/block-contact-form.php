<?php
$block = get_field( 'contact_form' ); ?>

    </div>
</div>

<section class="projects_block">
    <div class="container">
        <div class="projects_block__header">
            <?php if ( $subtitle = $block['subtitle'] ) : ?>
                <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ( $title = $block['title'] ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>

            <?php if ( $description = $block['description'] ) : ?>
                <div class="projects_block__description content">
                    <?php echo wp_kses_post( $description ); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $block['shortcode'] ) : ?>
            <div class="contact_form_container">
                <?php echo do_shortcode( $block['shortcode'] ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="container">
    <div class="content">