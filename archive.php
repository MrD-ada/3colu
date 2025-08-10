<?php get_header(); ?>

<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <header class="page-header">
        <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="archive-description">', '</div>' );
        ?>
      </header><?php if ( have_posts() ) : ?>
        <div class="list-ads top-ads">
          <?php dynamic_sidebar( 'ads_list_top' ); ?>
        </div>
        <?php
        $post_count = 0;
        while ( have_posts() ) : the_post();
          $post_count++;
          get_template_part( 'template-parts/content', 'list' );
          if ( $post_count == 3 ) :
            echo '<div class="list-ads mid-ads">';
            dynamic_sidebar( 'ads_list_mid' );
            echo '</div>';
          endif;
        endwhile;
        ?>
        <div class="list-ads bottom-ads">
          <?php dynamic_sidebar( 'ads_list_bottom' ); ?>
        </div>
        <?php the_posts_navigation(); ?>
      <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
      <?php endif; ?>

    </main></div><?php get_sidebar( 'left' ); ?>
  <?php get_sidebar( 'right' ); ?>
</div><?php get_footer(); ?>