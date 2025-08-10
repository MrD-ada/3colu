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
          
          <?php if ( is_active_sidebar( 'ads_list_top' ) ) : ?>
            <div class="list-ads top-ads">
              <?php dynamic_sidebar( 'ads_list_top' ); ?>
            </div>
          <?php endif; ?>
          
          <?php while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-card' ); ?>>
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail-link">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'medium' ); ?>
                  </a>
                </div>
              <?php endif; ?>
              
              <div class="entry-card-content">
                <header class="entry-header">
                  <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                </header>
                
                <div class="entry-summary">
                  <?php the_excerpt(); ?>
                </div>
                
                <footer class="entry-footer">
                  <div class="entry-meta">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                  </div>
                </footer>
              </div>
            </article>
            
          <?php endwhile; ?>
          
          <?php if ( is_active_sidebar( 'ads_list_mid' ) ) : ?>
            <div class="list-ads mid-ads">
              <?php dynamic_sidebar( 'ads_list_mid' ); ?>
            </div>
          <?php endif; ?>
          
          <nav class="pagination-wrapper">
              <?php the_posts_pagination( array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( '前のページ', '3colu' ) . '</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( '次のページ', '3colu' ) . '</span>',
                'mid_size'  => 1,
                'type'      => 'list',
              ) ); ?>
          </nav>
          
          <?php if ( is_active_sidebar( 'ads_list_bottom' ) ) : ?>
            <div class="list-ads bottom-ads">
              <?php dynamic_sidebar( 'ads_list_bottom' ); ?>
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