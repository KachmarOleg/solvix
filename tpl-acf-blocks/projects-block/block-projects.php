<?php
$block = get_field( 'projects_block' ); ?>

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


        <div class="projects_container">
            <?php if ( $projects = $block['projects'] ) :
                foreach ( $projects as $project ) :
                    get_template_part( 'tpl-parts/post-items/project', 'item', array( 'project' => $project ) );
                endforeach;
            endif; ?>
        </div>

        <?php if ( $button = $block['button'] ) : ?>
            <a href="<?php echo esc_url( $button['url'] ); ?>" class="projects_block__button is_outline_button" target="<?php echo $button['target'] ? : '_self'; ?>">
                <?php echo esc_html( $button['title'] ); ?>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.75 9H14.25" stroke="#49A7A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 3.75L14.25 9L9 14.25" stroke="#49A7A3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
</section>

<div class="container">
    <div class="content">