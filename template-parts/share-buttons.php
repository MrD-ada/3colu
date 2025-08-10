<?php
if ( ! function_exists( 'threecolu_share_buttons' ) ) {
    function threecolu_share_buttons() {
        if ( is_single() ) :
            $post_title = get_the_title();
            $post_url   = get_permalink();
            $twitter_text = urlencode( $post_title . ' ' . $post_url );
            $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $post_url );
            $twitter_url  = 'https://twitter.com/intent/tweet?text=' . $twitter_text;
            ?>
            <div class="share-buttons-container">
                <a href="<?php echo esc_url( $facebook_url ); ?>" class="share-button facebook" target="_blank" rel="noopener noreferrer">Facebook</a>
                <a href="<?php echo esc_url( $twitter_url ); ?>" class="share-button twitter" target="_blank" rel="noopener noreferrer">Twitter</a>
            </div>
            <?php
        endif;
    }
}
threecolu_share_buttons();