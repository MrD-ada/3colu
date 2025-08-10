<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '3colu' ); ?></a>

  <header id="masthead" class="site-header">
    <div class="header-inner">
      <div class="site-branding">
        <?php
        if ( is_front_page() && is_home() ) :
          ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php
        else :
          ?>
          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
          <?php
        endif;
        $threecolu_description = get_bloginfo( 'description', 'display' );
        if ( $threecolu_description || is_customize_preview() ) :
          ?>
          <p class="site-description"><?php echo $threecolu_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
      </div><button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="hamburger-icon"></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', '3colu' ); ?></span>
      </button>

      <nav id="site-navigation" class="main-navigation">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'header-menu',
            'menu_id'        => 'primary-menu',
          )
        );
        ?>
      </nav></div><?php if ( is_active_sidebar( 'ads_header' ) ) : ?>
      <div class="ads-header">
        <?php dynamic_sidebar( 'ads_header' ); ?>
      </div>
    <?php endif; ?>
  </header><div id="content" class="site-content-wrapper">