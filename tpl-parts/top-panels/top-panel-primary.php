<?php
$part_args = ! empty( $args ) ? $args : array();
$title = $part_args['title'] ?? '';
$subtitle = $part_args['subtitle'] ?? '';
$buttons = $part_args['buttons'] ?? '';
$achievements = $part_args['achievements'] ?? '';

$thumb_id = get_post_thumbnail_id( get_the_ID() );
?>

<section class="top_panel top_panel__primary">
	<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
		<figure>
			<?php echo wp_get_attachment_image( $thumb_id, 'full', false, array( 'alt' => get_alt( $thumb_id ), 'class' => 'object_fit' ) ); ?>
		</figure>
	<?php endif; ?>

	<div class="container">
        <?php echo get_the_content(); ?>

        <?php if ( $title ) : ?>
            <h1>
                <?php echo wp_kses_post($title); ?>
            </h1>
        <?php endif; ?>

        <?php if ( $subtitle ) : ?>
            <div>
                <?php echo wp_kses_post($subtitle); ?>
            </div>
        <?php endif; ?>

        <?php if ( $buttons ) : ?>
            <div class="wp-block-buttons"><!-- wp:button -->
                <?php foreach ($buttons as $button) : ?>
                    <?php if ( $button ) : ?>
                        <div class="wp-block-button <?php echo $button['style'] === 'outline' ? 'is-style-outline' : ''?>">
                            <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $button['button']['url'] ); ?>" target="<?php echo $button['button']['target'] ? : '_self'; ?>">
                                <?php echo esc_html( $button['button']['title'] ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /wp:button -->
        <?php endif; ?>


        <?php if ( $achievements ) : ?>
            <div class="achievements_block">
                <?php foreach ($achievements as $achievement) : ?>
                    <div class="achievement_item">
                    <span class="achievement_number">
                        <span class="animate_number"><?php echo esc_html($achievement['value']['number']); ?></span><?php echo esc_html($achievement['value']['text_after']); ?>
                    </span>
                        <span class="achievement_text"><?php echo esc_html($achievement['title']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
	</div>
</section>
