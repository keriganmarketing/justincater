<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta id="viewport-tag" name="viewport" content="width=device-width"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="Icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Mobile Header") ) : ?><?php endif ?>
<div id="main-wrapper">
<div class="main-bg"></div>
 <div id="header-wrapper">
		<div id="header">
			<div class="container">
				<div class="row">
			 		<div id="header-logo" class="col-md-5">
			 			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header left') ) : ?><?php endif; ?>
			 		</div>
			 		<div id="header-contact" class="col-md-7">
			 			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Contact') ) : ?><?php endif; ?>
			 		</div>	
					<div id="navigation" class="col-md-7">
					       <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'navi', 'theme_location' => 'primary-menu' ) ); ?>
					</div> 			 		
 	     		</div>	            			
			 </div>
		</div>	
	</div> 
		<main>
		<?php if ( !is_home() ) : ?>
		<div id="inner-page-wrapper">
			<div class="container">
				<?php 
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p class="yoast-breadcrumbs">','</p>');
					} 
				?>
		<?php endif ?>