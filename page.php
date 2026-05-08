<?php get_header(); ?>

<h1 class="is_visually_hidden"><?php the_title(); ?></h1>

<?php get_template_part( 'tpl-parts/gutenberg' ); ?>

<?php
$file_name = basename( __FILE__, '.php' );
tpl_style( $file_name );

get_footer();
?>
