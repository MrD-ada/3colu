<?php get_header(); ?>

<div class="site-content-wrapper">

  <?php if ( is_active_sidebar( 'ads_sticky_left' ) && !wp_is_mobile() ) : ?>
    <div class="sticky-sidebar left">
      <?php dynamic_sidebar( 'ads_sticky_left' ); ?>
    </div>
  <?php endif; ?>

  <div class="site-content">
    
    <?php get_sidebar( 'left' ); ?>
    
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        
        <?php if ( have_posts() ) : ?>
          
          <?php if ( is_active_sidebar( 'ads_single_top' ) ) : ?>
            <div class="list-ads top-ads">
              <?php dynamic_sidebar( 'ads_single_top' ); ?>
            </div>
          <?php endif; ?>
          
          <?php while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part( 'template-parts/content', 'single' ); ?>
            
            <?php if ( is_active_sidebar( 'ads_single_mid' ) ) : ?>
              <div class="list-ads mid-ads">
                <?php dynamic_sidebar( 'ads_single_mid' ); ?>
              </div>
            <?php endif; ?>
            
            <?php
            the_post_navigation( array(
              'prev_text' => '<span class="nav-subtitle">' . esc_html__( '前の記事:', '3colu' ) . '</span> <span class="nav-title">%title</span>',
              'next_text' => '<span class="nav-subtitle">' . esc_html__( '次の記事:', '3colu' ) . '</span> <span class="nav-title">%title</span>',
            ) );
            ?>
            
            <?php
              // If comments are open or we have at least one comment, load up the comment template.
            /*  if ( comments_open() || get_comments_number() ) :
                comments_template();
              endif;

          */
            ?>
            
          <?php endwhile; ?>
          
          <?php if ( is_active_sidebar( 'ads_single_bottom' ) ) : ?>
            <div class="list-ads bottom-ads">
              <?php dynamic_sidebar( 'ads_single_bottom' ); ?>
            </div>
          <?php endif; ?>
          
        <?php else : ?>
          
          <?php get_template_part( 'template-parts/content', 'none' ); ?>
          
        <?php endif; ?>
        
      </main></div><?php get_sidebar( 'right' ); ?>
    
  </div><?php if ( is_active_sidebar( 'ads_sticky_right' ) && !wp_is_mobile() ) : ?>
    <div class="sticky-sidebar right">
      <?php dynamic_sidebar( 'ads_sticky_right' ); ?>
    </div>
  <?php endif; ?>
  
</div><?php get_footer(); ?>