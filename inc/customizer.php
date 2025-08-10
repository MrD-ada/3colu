<?php
/**
 * テーマカスタマイザーの設定
 */
function threecolu_customize_register( $wp_customize ) {
    // アクセントカラー設定
    $wp_customize->add_setting( '3colu_accent_color', array(
        'default'   => '#e63946',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '3colu_accent_color_control', array(
        'label'    => 'アクセントカラー',
        'section'  => 'colors',
        'settings' => '3colu_accent_color',
    ) ) );

    // 外部RSS表示機能の設定
    $wp_customize->add_section( '3colu_rss_options', array(
        'title'    => 'RSS表示設定',
        'priority' => 120,
    ) );
    $wp_customize->add_setting( '3colu_rss_url', array(
        'default'   => '',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( '3colu_rss_url_control', array(
        'label'    => 'RSSフィードURL',
        'section'  => '3colu_rss_options',
        'settings' => '3colu_rss_url',
        'type'     => 'url',
    ) );
    $wp_customize->add_setting( '3colu_rss_count', array(
        'default'   => 5,
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( '3colu_rss_count_control', array(
        'label'    => '表示件数',
        'section'  => '3colu_rss_options',
        'settings' => '3colu_rss_count',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
        ),
    ) );
}
add_action( 'customize_register', 'threecolu_customize_register' );