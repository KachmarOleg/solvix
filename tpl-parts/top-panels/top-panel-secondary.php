<?php
$thumb_id = get_post_thumbnail_id( get_the_ID() );
global $post;
$project = $post;


$top_panel = get_field('top_panel', get_the_ID());
$button_url = $top_panel['project_url'] ?? null;
?>

<section class="top_panel top_panel__secondary">
	<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
		<figure>
			<?php echo wp_get_attachment_image( $thumb_id, 'full', false, array( 'alt' => get_alt( $thumb_id ), 'class' => 'object_fit' ) ); ?>
		</figure>
	<?php endif; ?>

	<div class="container">
        <?php if ( custom_tax($project->ID, 'industry') ) : ?>
            <div class="subtitle"><?php echo custom_tax($project->ID, 'industry'); ?></div>
        <?php endif; ?>

		<h1><?php echo get_the_title(); ?></h1>

        <?php if ( $project->post_excerpt ) : ?>
            <div class="top_panel__description content">
                <?php echo wp_kses_post( $project->post_excerpt ); ?>
            </div>
        <?php endif; ?>
        
        <?php if ( $button_url ) : ?>
            <a href="<?php echo esc_url( $button_url ); ?>" class="project_button button" target="_blank">
                View Project
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.75 9H14.25" stroke="#021517" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 3.75L14.25 9L9 14.25" stroke="#021517" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        <?php endif; ?>
	</div>
</section>
