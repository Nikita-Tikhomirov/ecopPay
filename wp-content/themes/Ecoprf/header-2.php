<!DOCTYPE html>
<html lang="ru">
  <head>
        <title>
            <?php
            if (is_home () ) { bloginfo('name'); } elseif ( is_category() ) { single_cat_title(); echo ' - ' ; bloginfo('name'); } 
            elseif (is_single() ) { single_post_title(); } 
            elseif (is_page() ) {  single_post_title(); } 
            else { wp_title('',true); } 
            ?>
        </title>
        <?php wp_head(); ?>
         <link rel="canonical" href="<?php echo get_permalink(get_the_ID()); ?>">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body <?php body_class(); ?>>





