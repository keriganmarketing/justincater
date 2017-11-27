<?php
/*
 * Register sidebars
 */
function register_ai_child_starter_theme_sidebars() {

	register_sidebar(array(
		'name' => 'Header Left',
		'id'=>'header-logo',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name' => 'Header Contact',
		'id'=>'header-contact',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name' => 'HP Slideshow',
		'id'=>'hp-slideshow',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name' => 'HP CTA',
		'id'=>'hp-cta',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'Property CTA',
		'id'=>'property-cta',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'HP Quick Search',
		'id'=>'quick-search',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'HP Welcome',
		'id'=>'hp-welcome',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'HP Featured Properties',
		'id'=>'hp-properties',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'HP Testimonials',
		'id'=>'hp-testimonials',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'Footer Contact',
		'id'=>'footer-contact',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));
	register_sidebar(array(
		'name' => 'Footer Logos',
		'id'=>'footer-logos',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));



}

add_action( 'widgets_init', 'register_ai_child_starter_theme_sidebars', 11 );

/*
 * Enqueue theme styles and scripts
 */
function ai_starter_theme_enqueue_child_assets() {

	/* Enqueue my scripts */
	wp_enqueue_script('slick', get_bloginfo('stylesheet_directory')."/js/slick.min.js");
	wp_enqueue_script('aios-nav-double-tap', 'http://cdn.thedesignpeople.net/agentimage-libraries/jquery.nav-tab-double-tap.js');
	wp_enqueue_script('jquery-anchor-single-tap', get_stylesheet_directory_uri() . '/js/jquery.anchor-single-tap.js');
	wp_enqueue_script('jquery-offset-scroll-for-header', get_stylesheet_directory_uri() . '/js/jquery.offsetScrollForHeader.js');
	wp_enqueue_script('aios-starter-theme-child-script', get_stylesheet_directory_uri(). '/js/scripts.js');

}

function register_jcater_menus() {
	register_nav_menu( 'mobile-menu', 'Mobile Menu' );
}
add_action( 'init', 'register_jcater_menus' );

	/* Enqueue my style */
	wp_enqueue_style('slick-css', get_bloginfo('stylesheet_directory')."/js/slick.css");
	wp_enqueue_style('Fonts','https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,900,900i');
	add_action( 'wp_enqueue_scripts', 'ai_starter_theme_enqueue_child_assets', 11 );
	add_action( 'wp_enqueue_scripts', 'ai_starter_theme_remove_media_queries_from_child_stylesheet', 13 );

/*
 * Add image sizes
 */
//add_image_size('cyclone-slide', 1024, 768, true);

/*
 * Define content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

//Shortcode for WP function get_template_directory_uri();
function bfp_get_template_directory() {
	$directory = get_stylesheet_directory_uri();
	return $directory;
}
add_shortcode( 'stylesheet_directory', 'bfp_get_template_directory' );

function blogurl_shortcode_func() {
	$directory = site_url();
	return $directory;
}
add_shortcode( 'blogurl', 'blogurl_shortcode_func' );

//add email function here for shortcode
function email_shortcode_func( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'email' => ''
    ), $atts );
    return '<a href="mailto:'.$a['email'].'">'.$content.'</a>';
}
add_shortcode( 'mail_to', 'email_shortcode_func' );

//agentimage credits
function agentimage_func( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'credits' => ''
    ), $atts );
    return $a['credits'];
}
add_shortcode( 'agentimage_credits', 'agentimage_func' );

//featured properties
function featuredproperties_func( $atts, $content = null ) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://mls.kerigan.com/api/agentlistings/B4557");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = json_decode(curl_exec($ch));

	$return = '<h2>Featured <strong>Properties</strong></h2>';
	$return .= '<div class="fp-slides">';

	$i = 0;
	foreach($output as $listing){
		$url = str_replace(' ','-',$listing->street_number.'-'.$listing->street_name.'-'.$listing->city.'-'.$listing->state.'-'.$listing->zip.'/'.$listing->mls_account.'/291/');
		$return .= '<div class="fp slick-slide" data-slick-index="'.$i.'" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide'.$i.'" style="width: 635px;">
	    <a href="/homes-for-sale-details/'.$url.'" tabindex="-1">
	        <div class="imageWrap" style="background-image: url(\''.$listing->preferred_image.'\')">
	        <!-- <img src="'.$listing->preferred_image.'" alt="Justin Cater" width="533" height="222"> -->
	        </div>
	        <div class="fp-content">
	        <span class="fp-price">$'.number_format($listing->price).'</span>
	        <span class="fp-add">'.$listing->street_number.' '.$listing->street_name.'<br>'.$listing->city.', '.$listing->state.' '.$listing->zip.'</span>
	        </div>
	    </a>
	    </div>';
		$i++;
	}
	$return .= '</div>';

	curl_close($ch);

	return $return;
}
add_shortcode( 'featuredproperties', 'featuredproperties_func' );

//agentimage Buyer
function buyer_func( $atts, $content = null ){

	$buyerinfo = '
	<div class="aios-roadmaps buyers-roadmap black no-border">
		<a class="aios-roadmap-link three-line" href="/buyers/deciding-to-buy/">
		<span class="aios-roadmap-icon ai-icon-1"><!-- icon --></span>
		<span class="aios-roadmap-name"><br>Deciding To<br> Buy</span></a>
		<a class="aios-roadmap-link three-line active-link" href="/buyers/preparing-to-buy/">
		<span class="aios-roadmap-icon ai-icon-4"><!-- icon --></span>
		<span class="aios-roadmap-name"><br>Preparing <br>To Buy</span></a>
		<a class="aios-roadmap-link three-line" href="/buyers/choose-a-real-estate-agent/">
		<span class="aios-roadmap-icon ai-icon-2"><!-- icon --></span>
		<span class="aios-roadmap-name">Choosing A<br> Real Estate<br> Agent</span></a>
		<a class="aios-roadmap-link single-line" href="/buyers/time-to-go-shopping/">
		<span class="aios-roadmap-icon ai-icon-7"><!-- icon --></span>
		<span class="aios-roadmap-name"> Time to<br> Go Shopping</span></a>
		<a class="aios-roadmap-link three-line" href="/buyers/escrow-inspections-and-appraisals/">
		<span class="aios-roadmap-icon ai-icon-5"><!-- icon --></span>
		<span class="aios-roadmap-name">Escrow<br> Inspections &amp;<br> Appraisals</span></a>
		<a class="aios-roadmap-link " href="/buyers/moving-in/">
		<span class="aios-roadmap-icon ai-icon-6"><!-- icon --></span>
		<span class="aios-roadmap-name"><br>Moving In</span></a>
	</div>';

	return $buyerinfo;

}
add_shortcode( 'Buyer', 'buyer_func' );

//agentimage Seller
function seller_func( $atts, $content = null ){

	$sellerinfo = '
	<div class="aios-roadmaps sellers-roadmap black no-border">
	<a class="aios-roadmap-link three-line" href="/sellers/decide-to-sell/">
	<span class="aios-roadmap-icon ai-icon-1"><!-- icon --></span>
	<span class="aios-roadmap-name"><br> Decide<br> To Sell</span></a>
	<a class="aios-roadmap-link three-line" href="/sellers/select-an-agent-and-price/">
	<span class="aios-roadmap-icon ai-icon-4"><!-- icon --></span>
	<span class="aios-roadmap-name"><br> Select an<br> Agent &amp; Price</span></a>
	<a class="aios-roadmap-link three-line" href="/sellers/prepare-to-sell/">
	<span class="aios-roadmap-icon ai-icon-2"><!-- icon --></span>
	<span class="aios-roadmap-name"><br> Prepare<br> To Sell</span></a>
	<a class="aios-roadmap-link three-line" href="/sellers/accepting-an-offer/">
	<span class="aios-roadmap-icon ai-icon-7"><!-- icon --></span>
	<span class="aios-roadmap-name"><br> Accepting<br> An Offer</span></a>
	<a class="aios-roadmap-link three-line" href="/sellers/escrow-inspections-and-appraisals/">
	<span class="aios-roadmap-icon ai-icon-5"><!-- icon --></span>
	<span class="aios-roadmap-name">Escrow<br> Inspections<br> &amp; Appraisals</span></a>
	<a class="aios-roadmap-link three-line" href="/sellers/buying-your-next-home/">
	<span class="aios-roadmap-icon ai-icon-6"><!-- icon --></span>
	<span class="aios-roadmap-name"><br> Buying Your <br> Next Home</span></a>
	</div>
	';
	return $sellerinfo;

}
add_shortcode( 'Seller', 'seller_func' );
