<?php
$block = get_field( 'story_block' ); ?>

    </div>
</div>

<section class="story_block <?php echo $block['is_background_visible'] ? 'template_2' : ''; ?>">
    <div class="container">
        <div class="container_grid">
            <div class="start_1_cols_4 story_block__text">
                <?php if ( $subtitle = $block['subtitle'] ) : ?>
                    <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <div class="start_6_cols_6 ">
                <?php if ( $image = $block['image'] ) :
                    $img_id = $image['id']; ?>
                    <figure class="story_block__image">
                        <?php echo wp_get_attachment_image( $img_id, 'full', false, array( 'alt' => get_alt( $img_id ), 'class' => 'object_fit' ) ); ?>
                    </figure>
                <?php endif; ?>

                <?php if ( $description = $block['description'] ) : ?>
                    <div class="story_block__description content">
                        <?php echo wp_kses_post( $description ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="start_1_cols_12">
                <div class="cards_container">
                    <?php if ( $cards = $block['cards'] ) : ?>
                        <?php foreach ( $cards as $card ) : ?>
                            <div class="text_card <?php echo $card['is_accent'] ? 'text_card__accent' : ''; ?>">
                                <?php if ( $card['icon'] ) :
                                    $img_id   = $card['icon']['id'];
                                    $img_path = get_attached_file( $img_id );
                                    $filetype = wp_check_filetype( $img_path ); ?>

                                    <figure class="text_card__icon">
                                        <?php if ( $filetype['ext'] === 'svg' ) : ?>
                                            <?php echo file_get_contents( $img_path ); ?>
                                        <?php else : ?>
                                            <?php echo wp_get_attachment_image($img_id, 'full', false, array('alt'   => get_alt( $img_id ), 'class' => 'object_fit',)); ?>
                                        <?php endif; ?>
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
        </div>
    </div>
</section>

<div class="container">
    <div class="content">