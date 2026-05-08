<?php
$part_args = !empty($args) ? $args : array();
$project = $part_args['project'] ?? '';

$top_panel = get_field('top_panel', $project->ID);
$img_id = get_post_thumbnail_id($project->ID);
if ( !empty($top_panel) && !empty($top_panel['preview_image']) ) {
    if ( is_array($top_panel['preview_image']) ) {
        $img_id = $top_panel['preview_image']['id'] ?? $img_id;
    } else {
        $img_id = $top_panel['preview_image'];
    }
} ?>

<a href="<?php echo get_permalink($project->ID)?>" class="project_card" aria-label="Read more about <?php echo esc_html( $project->post_title ); ?>">
    <?php if ( $img_id ) : ?>
        <figure class="project_card__image">
            <?php echo wp_get_attachment_image( $img_id, 'full', false, array( 'alt' => get_alt( $img_id ), 'class' => 'object_fit' ) ); ?>
        </figure>
    <?php endif; ?>

    <div class="project_card__content">
        <div class="card_caption">
            <?php if ( $project->post_title ) : ?>
                <h3 class="project_card__title"><?php echo esc_html( $project->post_title ); ?></h3>
            <?php endif; ?>

            <?php if ( $project->post_excerpt ) : ?>
                <div class="project_card__description content">
                    <?php echo wp_kses_post( $project->post_excerpt ); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="project_card__button">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.75 9H14.25" stroke="#021517" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 3.75L14.25 9L9 14.25" stroke="#021517" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</a>

<?php tpl_style( 'project-item', 'tpl-parts' ); ?>