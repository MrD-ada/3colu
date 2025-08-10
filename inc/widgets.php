<?php
/**
 * 企画書に記載の全ウィジェットエリアを登録する
 */
function threecolu_register_all_widgets() {
    // 左サイドバー
    register_sidebar( array(
        'name'          => '左サイドバー',
        'id'            => 'sidebar-left',
        'description'   => '左カラムに表示されるウィジェットエリア',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // 右サイドバー
    register_sidebar( array(
        'name'          => '右サイドバー',
        'id'            => 'sidebar-right',
        'description'   => '右カラムに表示されるウィジェットエリア',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // 広告：ヘッダー下
    register_sidebar( array(
        'name'          => esc_html__( '広告：ヘッダー下', '3colu' ),
        'id'            => 'ads_header',
        'description'   => esc_html__( 'ヘッダーの直下に表示される広告ウィジェットエリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：記事タイトル上
    register_sidebar( array(
        'name'          => esc_html__( '広告：記事タイトル上', '3colu' ),
        'id'            => 'ads_single_top',
        'description'   => esc_html__( '記事詳細ページのタイトル直前に表示される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：本文中段
    register_sidebar( array(
        'name'          => esc_html__( '広告：本文中段', '3colu' ),
        'id'            => 'ads_single_mid',
        'description'   => esc_html__( '記事詳細ページの本文中間部分に自動挿入される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：記事下
    register_sidebar( array(
        'name'          => esc_html__( '広告：記事下', '3colu' ),
        'id'            => 'ads_single_bottom',
        'description'   => esc_html__( '記事詳細ページの本文直後に表示される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：記事一覧上
    register_sidebar( array(
        'name'          => esc_html__( '広告：記事一覧上', '3colu' ),
        'id'            => 'ads_list_top',
        'description'   => esc_html__( '記事一覧ページの最上部に表示される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：記事一覧中段
    register_sidebar( array(
        'name'          => esc_html__( '広告：記事一覧中段', '3colu' ),
        'id'            => 'ads_list_mid',
        'description'   => esc_html__( '記事一覧ページの途中（例：3件目の後）に表示される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：記事一覧下
    register_sidebar( array(
        'name'          => esc_html__( '広告：記事一覧下', '3colu' ),
        'id'            => 'ads_list_bottom',
        'description'   => esc_html__( '記事一覧ページの最下部に表示される広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：フッター上
    register_sidebar( array(
        'name'          => esc_html__( '広告：フッター上', '3colu' ),
        'id'            => 'ads_footer_top',
        'description'   => esc_html__( 'フッター直前に表示される広告ウィジェットエリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // フッターウィジェット
    register_sidebar( array(
        'name'          => esc_html__( 'フッターウィジェット', '3colu' ),
        'id'            => 'footer-widget',
        'description'   => esc_html__( 'コピーライト上部など、フッターに表示されるウィジェットエリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：左追尾サイドバー
    register_sidebar( array(
        'name'          => esc_html__( '広告：左追尾サイドバー', '3colu' ),
        'id'            => 'ads_sticky_left',
        'description'   => esc_html__( 'PC表示時に左サイドバーの外側に表示される追尾型広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
    
    // 広告：右追尾サイドバー
    register_sidebar( array(
        'name'          => esc_html__( '広告：右追尾サイドバー', '3colu' ),
        'id'            => 'ads_sticky_right',
        'description'   => esc_html__( 'PC表示時に右サイドバーの外側に表示される追尾型広告エリアです。', '3colu' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title screen-reader-text">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'threecolu_register_all_widgets' );