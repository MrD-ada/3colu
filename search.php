<?php get_header(); ?>

<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <header class="page-header">
        <h1 class="page-title">
          <?php
          printf( esc_html__( 'Search Results for: %s', '3colu' ), '<span>' . get_search_query() . '</span>' );
          ?>
        </h1>
      </header><?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/content', 'list' ); ?>
        <?php endwhile; ?>
        <?php the_posts_navigation(); ?>
      <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
      <?php endif; ?>

    </main></div><?php get_sidebar( 'left' ); ?>
  <?php get_sidebar( 'right' ); ?>
</div><?php get_footer(); ?>