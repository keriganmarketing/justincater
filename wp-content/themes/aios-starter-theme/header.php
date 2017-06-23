<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta id="viewport-tag" name="viewport" content="width=device-width"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Mobile Header") ) : ?><?php endif ?>
	
	<div id="main-wrapper" class="outer">

	<div class="aios-starter-theme-demo-header outer aios-mobile-pack-hide">
		<div class="aios-starter-theme-demo-header-title inner">
			<a href="<?php echo esc_url( home_url() ) ?>" class="site-name"><?php bloginfo('name'); ?></a>
		</div><!-- end .aios-starter-theme-demo-header-title -->
		
		<div class="aios-starter-theme-demo-header-navigation inner">
			<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) ); ?>
		</div><!-- end .aios-starter-theme-demo-header-navigation -->
	</div>
	
	<main>
		<?php if ( !is_home() ) : ?>
		<div id="inner-page-wrapper" class="outer">
			<div class="inner">
				<?php 
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p class="yoast-breadcrumbs">','</p>');
					} 
				?>
		<?php endif ?>
