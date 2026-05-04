<?php
$block = get_field( 'text_and_image' ); ?>

    </div>
</div>

<section class="text_and_image">
    <div class="container">
        <div class="container_grid">
            <div class="start_1_cols_6 text_and_image__text">
                <?php if ( $subtitle = $block['subtitle'] ) : ?>
                    <p class="text_and_image__subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <?php if ( $title = $block['title'] ) : ?>
                    <h2 class="text_and_image__title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( $description = $block['description'] ) : ?>
                    <div class="text_and_image__description content">
                        <?php echo wp_kses_post( $description ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="start_7_cols_6 text_and_image__image">
                <?php if ( $image = $block['image'] ) :
                    $img_id = $image['id']; ?>
                    <figure>
                        <?php echo wp_get_attachment_image( $img_id, 'full', false, array( 'alt' => get_alt( $img_id ), 'class' => 'object_fit' ) ); ?>
                    </figure>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="content">