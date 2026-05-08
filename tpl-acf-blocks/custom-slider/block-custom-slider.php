<?php
wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/js/libs/swiper.js', null, null, array('in_footer' => true, 'strategy' => 'defer' ) );
wp_enqueue_style( 'swiper', get_stylesheet_directory_uri() . '/style/libs/swiper.css', null, null );
wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/libs/fancybox.js', null, null, array('in_footer' => true, 'strategy' => 'defer' ) );
wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/style/libs/fancybox.css', null, null );

// get fields
$custom_slider = get_field( 'custom_slider' );
if ( $custom_slider ) :
	?>
    <div class="block__custom_slider">
        <div class="swiper">
            <div class="swiper-wrapper">
				<?php foreach ( $custom_slider as $index => $image ) : ?>
                    <div class="block__custom_slider_item swiper-slide">
                        <a href="<?php echo wp_get_attachment_image_url( $image['id'], 'full' ); ?>" 
                           data-fancybox="slider-gallery" 
                           data-caption="<?php echo get_alt( $image['id'] ); ?>"
                           class="slider-image-link">
                            <picture>
                                <source media="(max-width: 480px)" srcset="<?php echo wp_get_attachment_image_url( $image['id'], 'mob_slider' ); ?>">
                            	<?php echo wp_get_attachment_image( $image['id'], 'project_slider', false, array( 'alt' => get_alt( $image['id'] ), 'class' => '' ) ); ?>
                            </picture>
                        </a>
                    </div>
				<?php endforeach; ?>
            </div>

            <div class="sw_controls">
                <div class="sw_prev i_chevron_left"></div>
                <div class="sw_next i_chevron_right"></div>
            </div>
        </div>



        <?php if ( count( $custom_slider ) > 1 ) : ?>
            <div class="swiper_thumbs">
                <div class="swiper-wrapper">
					<?php foreach ( $custom_slider as $image ) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo wp_get_attachment_image_url( $image['id'], 'thumbnail' ); ?>" 
                                 alt="<?php echo get_alt( $image['id'] ); ?>">
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>