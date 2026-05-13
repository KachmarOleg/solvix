<?php
$block = get_field( 'hero_block' ); ?>

<section class="hero_block">
    <div class="container_grid">
        <div class="start_3_cols_8 hero_block__header text_center">
            <?php if ( $subtitle = $block['subtitle'] ) : ?>
                <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ( $title = $block['title'] ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>

            <?php if ( $description = $block['description'] ) : ?>
                <div class="hero_block__description content">
                    <?php echo wp_kses_post( $description ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
