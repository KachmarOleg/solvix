<?php
$block = get_field( 'founder_block' ); ?>

    </div>
</div>

<section class="founder_block">
    <div class="container">
        <div class="container_grid">
            <div class="start_1_cols_5 founder_block__text">
                <?php if ( $subtitle = $block['subtitle'] ) : ?>
                    <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <?php if ( $block['title'] ) : ?>
                    <div class="founder_block__title">
                        <?php echo wp_kses_post($block['title']); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $block['description'] ) : ?>
                    <div class="text_card__description content">
                        <?php echo wp_kses_post( $block['description'] ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="start_6_cols_7">
                <div class="founder_card">
                    <?php if ( $image = $block['founder_card']['image'] ) :
                        $img_id = $image['id']; ?>
                        <figure class="founder_block__image">
                            <?php echo wp_get_attachment_image( $img_id, 'full', false, array( 'alt' => get_alt( $img_id ), 'class' => 'object_fit' ) ); ?>
                        </figure>
                    <?php endif; ?>

                    <div class="founder_card__text_into">
                        <?php if ( $founder_position = $block['founder_card']['position'] ) : ?>
                            <p class="subtitle"><?php echo esc_html($founder_position); ?></p>
                        <?php endif; ?>

                        <?php if ( $founder_name = $block['founder_card']['name'] ) : ?>
                            <h3 class="title"><?php echo esc_html($founder_name); ?></h3>
                        <?php endif; ?>

                        <?php if ( $founder_description = $block['founder_card']['description'] ) : ?>
                            <div class="description content">
                                <?php echo wp_kses_post( $founder_description ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $founder_url = $block['founder_card']['linkedin_url'] ) : ?>
                            <a href="<?php echo esc_url( $founder_url ); ?>" class="projects_block__button button" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-linkedin h-4 w-4" aria-hidden="true">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect width="4" height="12" x="2" y="9"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                                Connect on LinkedIn
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="content">