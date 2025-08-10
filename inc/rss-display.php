<?php
/**
 * サイドバーに外部RSS記事を表示する独自機能
 */
function threecolu_display_rss_feed() {
    $rss_url = get_theme_mod( '3colu_rss_url', '' );
    $rss_count = get_theme_mod( '3colu_rss_count', 5 );

    if ( ! empty( $rss_url ) && function_exists( 'fetch_feed' ) ) {
        $rss = fetch_feed( $rss_url );
        if ( ! is_wp_error( $rss ) ) {
            $maxitems = $rss->get_item_quantity( $rss_count );
            $rss_items = $rss->get_items( 0, $maxitems );
            ?>
            <div id="rss_feed" class="widget widget_rss">
                <h3 class="widget-title">外部RSS</h3>
                <ul>
                    <?php if ( $maxitems == 0 ) : ?>
                        <li><?php esc_html_e( 'RSSフィードがありません。', '3colu' ); ?></li>
                    <?php else : ?>
                        <?php foreach ( $rss_items as $item ) : ?>
                            <li><a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html( $item->get_title() ); ?>
                            </a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <?php
        }
    }
}