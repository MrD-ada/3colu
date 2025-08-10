<?php get_header(); ?>

<div class="site-content-wrapper">
  <div class="site-content">
    
    <!-- 左サイドバー -->
    <?php get_sidebar( 'left' ); ?>
    
    <!-- メインコンテンツ -->
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        
        <?php if ( have_posts() ) : ?>
          
          <!-- トップ広告 -->
          <?php if ( is_active_sidebar( 'ads_page_top' ) ) : ?>
            <div class="list-ads top-ads">
              <?php dynamic_sidebar( 'ads_page_top' ); ?>
            </div>
          <?php endif; ?>
          
          <?php while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
            
            <!-- 中間広告 -->
            <?php if ( is_active_sidebar( 'ads_page_mid' ) ) : ?>
              <div class="list-ads mid-ads">
                <?php dynamic_sidebar( 'ads_page_mid' ); ?>
              </div>
            <?php endif; ?>
            
            <!-- コメント -->
            <?php
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
            ?>
            
          <?php endwhile; ?>
          
          <!-- ボトム広告 -->
          <?php if ( is_active_sidebar( 'ads_page_bottom' ) ) : ?>
            <div class="list-ads bottom-ads">
              <?php dynamic_sidebar( 'ads_page_bottom' ); ?>
            </div>
          <?php endif; ?>
          
        <?php else : ?>
          
          <?php get_template_part( 'template-parts/content', 'none' ); ?>
          
        <?php endif; ?>
        
      </main><!-- #main -->
    </div><!-- #primary -->
    
    <!-- 右サイドバー -->
    <?php get_sidebar( 'right' ); ?>
    
  </div><!-- .site-content -->
</div><!-- .site-content-wrapper -->

<?php get_footer(); ?>