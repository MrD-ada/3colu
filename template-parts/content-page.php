<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page' ); ?>>
  
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    
    <div class="entry-meta">
      <span class="posted-on">
        <time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          最終更新: <?php echo get_the_modified_date(); ?>
        </time>
      </span>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
  
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
    </div>
  <?php endif; ?>
  
  <div class="entry-content">
    <?php
    the_content();
    
    wp_link_pages( array(
      'before' => '<div class="page-links">' . esc_html__( 'ページ:', '3colu' ),
      'after'  => '</div>',
    ) );
    ?>
  </div><!-- .entry-content -->
  
  <footer class="entry-footer">
    <?php
    edit_post_link(
      sprintf(
        wp_kses(
          __( '編集 <span class="screen-reader-text">"%s"</span>', '3colu' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        get_the_title()
      ),
      '<span class="edit-link">',
      '</span>'
    );
    ?>
  </footer><!-- .entry-footer -->
  
</article><!-- #post-<?php the_ID(); ?> -->