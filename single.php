<?php get_header(); ?>

<?php get_template_part( 'tpl-parts/top-panels/top-panel', 'secondary' ); ?>

<?php get_template_part( 'tpl-parts/single/single', 'meta' ); ?>

<?php get_template_part( 'tpl-parts/gutenberg', null ); ?>

<?php
$cta_block = get_field( 'cta_block', 'option' );
if ( $cta_block ) {
    get_template_part( 'tpl-acf-blocks/cta-block/block', 'cta', array( 'block' => $cta_block ) );
} ?>

<?php get_template_part( 'tpl-parts/single/single', 'related' ); ?>

<?php
$file_name = basename( __FILE__, '.php' );
tpl_style( $file_name );

get_footer();
?>
