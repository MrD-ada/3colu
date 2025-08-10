<aside id="secondary-left" class="sidebar widget-area">
  <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-left' ); ?>
  <?php else : ?>
    <div id="profile" class="widget widget_profile">
      <h3 class="widget-title">プロフィール</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile.png" alt="プロフィール画像">
      <p>ここに自己紹介文が入ります。</p>
    </div>
    <div id="search" class="widget widget_search">
      <h3 class="widget-title">検索</h3>
      <?php get_search_form(); ?>
    </div>
    <div id="categories" class="widget widget_categories">
      <h3 class="widget-title">カテゴリー</h3>
      <ul>
        <?php wp_list_categories( 'title_li=' ); ?>
      </ul>
    </div>
    <div id="tag_cloud" class="widget widget_tag_cloud">
      <h3 class="widget-title">タグクラウド</h3>
      <?php wp_tag_cloud(); ?>
    </div>
    <div id="popular_posts" class="widget widget_popular_posts">
      <h3 class="widget-title">人気記事</h3>
      <ul>
        <?php
        $popular_posts = new WP_Query( array(
            'posts_per_page' => 5,
            'meta_key'       => 'post_views_count',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC'
        ) );
        if ( $popular_posts->have_posts() ) :
          while ( $popular_posts->have_posts() ) : $popular_posts->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </ul>
    </div>
    <div id="ads-sidebar-left" class="widget widget_ads">
      <h3 class="widget-title">広告</h3>
      <img src="https://via.placeholder.com/250x250.png?text=Ad+Space" alt="広告">
    </div>
  <?php endif; ?>
</aside>