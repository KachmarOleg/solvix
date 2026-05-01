<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$buttons = get_field('buttons');
$achievements = get_field('achievements');

get_template_part( 'tpl-parts/top-panels/top-panel', 'primary', ['title' => $title, 'subtitle' => $subtitle, 'buttons' => $buttons, 'achievements' => $achievements] ); ?>