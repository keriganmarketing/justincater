<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta id="viewport-tag" name="viewport" content="width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
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
    <div id="mobile-header" class="hidden-sm-up">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="col-sm-3">
                        <span type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="icon-label">MENU</span>
                            <span class="hamburger">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </span>
                    </div>
                    <div class="col-sm-9">
                        <div id="mobile-contact" class="text-center" >
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Contact') ) : ?><?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'mobilenavi', 'theme_location' => 'mobile-menu' ) ); ?>
                </div>
            </div>
        </nav>
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