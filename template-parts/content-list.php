<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-card' ); ?>>
  
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail-link">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
      </a>
    </div>
  <?php endif; ?>
  
  <div class="entry-card-content">
    <header class="entry-header">
      <?php
      if ( is_singular() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
      else :
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      endif;
      ?>
    </header><!-- .entry-header -->
    
    <div class="entry-summary">
      <?php
      if ( has_excerpt() ) {
        the_excerpt();
      } else {
        echo wp_trim_words( get_the_content(), 50, '...' );
      }
      ?>
    </div><!-- .entry-summary -->
    
    <footer class="entry-meta">
      <span class="posted-on">
        <time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          <?php echo get_the_date(); ?>
        </time>
      </span>
      
      <?php
      $categories_list = get_the_category_list( esc_html__( ', ', '3colu' ) );
      if ( $categories_list ) :
        ?>
        <span class="cat-links">
          <?php echo $categories_list; ?>
        </span>
        <?php
      endif;
      
      if ( comments_open() || get_comments_number() ) :
        ?>
        <span class="comments-link">
          <?php comments_popup_link( 
            esc_html__( 'コメントする', '3colu' ), 
            esc_html__( '1件のコメント', '3colu' ), 
            esc_html__( '%件のコメント', '3colu' ) 
          ); ?>
        </span>
        <?php
      endif;
      ?>
    </footer><!-- .entry-meta -->
    
  </div><!-- .entry-card-content -->
  
</article><!-- #post-<?php the_ID(); ?> -->