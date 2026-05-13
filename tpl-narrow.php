<?php get_header();
/**
 * Template Name: Narrow
 */
?>

<?php get_template_part( 'tpl-parts/gutenberg', '', ['class' => 'narrow_container'] ); ?>

<?php
$file_name = basename( __FILE__, '.php' );
tpl_style( $file_name );

get_footer();
?>
