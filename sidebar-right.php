<aside id="secondary-right" class="sidebar widget-area">
  <?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-right' ); ?>
  <?php else : ?>
    <div id="ads-sidebar-right-top" class="widget widget_ads">
      <h3 class="widget-title">広告</h3>
      <img src="https://via.placeholder.com/250x250.png?text=Ad+Space" alt="広告">
    </div>
    <div id="recent_posts" class="widget widget_recent_posts">
      <h3 class="widget-title">新着記事</h3>
      <ul>
        <?php
        $recent_posts = wp_get_recent_posts( array( 'numberposts' => 5, 'post_status' => 'publish' ) );
        foreach( $recent_posts as $post ) :
          setup_postdata( $post );
          echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        endforeach;
        wp_reset_postdata();
        ?>
      </ul>
    </div>
    <?php threecolu_display_rss_feed(); ?>
    <div id="banner_ads" class="widget widget_banner_ads">
      <h3 class="widget-title">バナー広告</h3>
      <img src="https://via.placeholder.com/250x100.png?text=Banner+Ad" alt="バナー広告">
    </div>
    <div id="social_links" class="widget widget_social_links">
      <h3 class="widget-title">SNS</h3>
      <ul class="social-links">
          <li><a href="#" class="facebook" target="_blank">Facebook</a></li>
          <li><a href="#" class="twitter" target="_blank">Twitter</a></li>
          <li><a href="#" class="instagram" target="_blank">Instagram</a></li>
      </ul>
    </div>
    <div id="ads-sidebar-right-bottom" class="widget widget_ads">
      <h3 class="widget-title">広告</h3>
      <img src="https://via.placeholder.com/250x250.png?text=Ad+Space" alt="広告">
    </div>
  <?php endif; ?>
</aside>