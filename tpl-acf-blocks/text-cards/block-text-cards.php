<?php
$block = get_field( 'text_cards' ); ?>

    </div>
</div>

<section class="text_cards">
    <div class="container">
        <div class="text_cards__header text_center">
            <?php if ( $subtitle = $block['subtitle'] ) : ?>
                <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
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

        <div class="cards_container">
            <?php if ( $cards = $block['cards'] ) : ?>
                <?php foreach ( $cards as $card ) : ?>
                    <div class="text_card">
                        <?php if ( $card['icon'] ) :
                            $img_id = $card['icon']['id']; ?>
                            <figure class="text_card__icon">
                                <?php echo wp_get_attachment_image( $img_id, 'full', false, array( 'alt' => get_alt( $img_id ), 'class' => 'object_fit' ) ); ?>
                            </figure>
                        <?php endif; ?>

                        <?php if ( $card['title'] ) : ?>
                            <h3 class="text_card__title"><?php echo esc_html( $card['title'] ); ?></h3>
                        <?php endif; ?>

                        <?php if ( $card['description'] ) : ?>
                            <div class="text_card__description content">
                                <?php echo wp_kses_post( $card['description'] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="container">
    <div class="content">