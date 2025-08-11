<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
  
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    
    <div class="entry-meta">
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
          カテゴリー: <?php echo $categories_list; ?>
        </span>
        <?php
      endif;
      
      $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '3colu' ) );
      if ( $tags_list ) :
        ?>
        <span class="tags-links">
          タグ: <?php echo $tags_list; ?>
        </span>
        <?php
      endif;
      ?>
      
      <?php if ( comments_open() || get_comments_number() ) : ?>
        <span class="comments-link">
          <?php comments_popup_link( 
            esc_html__( 'コメントする', '3colu' ), 
            esc_html__( '1件のコメント', '3colu' ), 
            esc_html__( '%件のコメント', '3colu' ) 
          ); ?>
        </span>
      <?php endif; ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->
  
  <?php if ( is_active_sidebar( 'ads_single_after_title' ) ) : ?>
    <div class="list-ads after-title-ads">
      <?php dynamic_sidebar( 'ads_single_after_title' ); ?>
    </div>
  <?php endif; ?>
  
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
    </div>
  <?php endif; ?>
  
  <div class="entry-content">
    <?php
    the_content( sprintf(
      wp_kses(
        __( '続きを読む<span class="screen-reader-text"> "%s"</span>', '3colu' ),
        array(
          'span' => array(
            'class' => array(),
          ),
        )
      ),
      get_the_title()
    ) );
    
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