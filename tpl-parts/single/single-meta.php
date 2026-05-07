<?php
// Get project details from ACF fields
$meta_section = get_field('meta_section');
$brand = $meta_section['brand'] ?? '';
$client = $meta_section['client'] ?? '';
$industry = $meta_section['industry'] ?? '';
$cost = $meta_section['cost'] ?? '';
$release_date = $meta_section['release'] ?? '';
$technologies = $meta_section['technologies'] ?? '';
?>

<div class="single_post__meta">
    <div class="container">
        <div class="single_post__meta__inner">
            <?php if ( $brand ) : ?>
                <div class="meta-item">
                    <span class="meta-label">Brand:</span>
                    <span class="meta-value"><?php echo esc_html( $brand ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $client ) : ?>
                <div class="meta-item">
                    <span class="meta-label">Client:</span>
                    <span class="meta-value"><?php echo esc_html( $client ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $industry ) : ?>
                <div class="meta-item">
                    <span class="meta-label">Industry:</span>
                    <span class="meta-value"><?php echo esc_html( $industry ); ?></span>
                </div>
            <?php endif; ?>

            <?php if ( $cost && is_numeric( $cost ) ) : ?>
                <div class="meta-item">
                    <span class="meta-label">Cost:</span>
                    <div class="cost-rating">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                            <svg class="cost-tag <?php echo $i <= $cost ? 'active' : ''; ?>" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path>
                                <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>
                            </svg>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $release_date ) : ?>
                <div class="meta-item">
                    <span class="meta-label">Release:</span>
                    <span class="meta-value"><?php echo esc_html( $release_date ); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $technologies && !empty( $technologies ) ) : ?>
            <div class="single_post__meta__inner technologies_info">
                <div class="meta-item">
                    <span class="meta-label">Technologies:</span>
                    <div class="technologies-list">
                        <?php foreach ( $technologies as $tech ) : ?>
                            <?php if ( isset( $tech->post_title ) ) : ?>
                                <span class="tech-tag"><?php echo esc_html( $tech->post_title ); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
