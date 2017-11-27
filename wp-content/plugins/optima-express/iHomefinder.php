<?php
/*
Plugin Name: Optima Express IDX Plugin
Plugin URI: http://wordpress.org/extend/plugins/optima-express/
Description: Adds MLS / IDX property search and listings to your site. Includes search and listing pages, widgets and shortcodes. Requires an IDX account from iHomefinder. Get a free trial account with sample IDX data, or a paid account with data from your MLS.
Version: 4.0.2
Author: ihomefinder
Author URI: http://www.ihomefinder.com
License: GPL
*/

include "iHomefinderAutoloader.php";

$autoloader = iHomefinderAutoloader::getInstance();
$installer = iHomefinderInstaller::getInstance();
$rewriteRules = iHomefinderRewriteRules::getInstance();
$admin = iHomefinderAdmin::getInstance();
$shortcodeSelector = iHomefinderShortcodeSelectorTinyMce::getInstance();
$shortcodeDispatcher = iHomefinderShortcodeDispatcher::getInstance();
$stateManager = iHomefinderStateManager::getInstance();
$enqueueResource = iHomefinderEnqueueResource::getInstance();
$virtualPageDispatcher = iHomefinderVirtualPageDispatcher::getInstance();
$displayRules = iHomefinderDisplayRules::getInstance();
$ajaxHandler = iHomefinderAjaxHandler::getInstance();

//Runs when plugin is activated
register_activation_hook(__FILE__, array($installer, "install"));
//Runs on plugin deactivation
register_deactivation_hook(__FILE__, array($installer, "remove"));

//Runs just before the auto upgrader installs the plugin
add_filter("upgrader_post_install", array($installer, "upgrade"), 10, 2);

//uncomment during development, so rule changes can be viewed.
//in production this should not run, because it is a slow operation.
//add_action("init", array($rewriteRules, "flushRules"));

//Rewrite Rules
add_action("init", array($rewriteRules, "initialize"), 1);

if(is_admin()) {
	add_action("admin_enqueue_scripts", array($admin, "addScripts"));
	add_action("admin_menu", array($admin, "createAdminMenu"));
	add_action("admin_init", array($installer, "upgrade"));
	add_action("admin_init", array($admin, "registerSettings"));
	//Adds functionality to the text editor for pages and posts
	//Add buttons to text editor and initialize short codes
	add_action("admin_init", array($shortcodeSelector, "addButtons"));
	//add error check
	add_action("admin_notices", array($admin, "checkError"));
} else {
	/*
	Call upgrade method on every non-admin page load. This is for the case that the plugin is updated through
	multisite network admin	or if the plugin files were manually copied into wordpress.
	*/
	add_action("setup_theme", array($installer, "upgrade"));
	add_action("setup_theme", array($stateManager, "setupLeadCaptureUser"));
	add_action("init", array($enqueueResource, "enqueue"));
	add_action("wp_head", array($enqueueResource, "getMetaTags"), -100);
	add_action("wp_head", array($enqueueResource, "getHeader"));
	add_action("wp_footer", array($enqueueResource, "getFooter"));
	add_filter("page_template", array($virtualPageDispatcher, "getPageTemplate"));
	add_filter("the_content", array($virtualPageDispatcher, "getContent"), 20);
	add_filter("the_excerpt", array($virtualPageDispatcher, "getExcerpt"), 20);
	add_filter("the_posts", array($virtualPageDispatcher, "postCleanUp"), 20000);
	add_filter("comments_array", array($virtualPageDispatcher, "clearComments"));
	if($displayRules->isSitemapEnabled()) {
		add_action("sm_buildmap", array($admin, "addSitemapForGoogleXmlSitemaps"));
		add_filter("wpseo_sitemap_page_content", array($admin, "addSitemapForYoastWordPressSeo"));
	}
}

//shortcode
add_action("init", array($shortcodeDispatcher, "initialize"));

//widgets
if($displayRules->isPropertiesGalleryEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderPropertiesGallery');"));
}
if($displayRules->isQuickSearchEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderQuickSearchWidget');"));
}
if($displayRules->isSeoCityLinksEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderLinkWidget');"));
}
if($displayRules->isSearchByAddressEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderSearchByAddressWidget');"));
}
if($displayRules->isSearchByListingIdEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderSearchByListingIdWidget');"));
}
if($displayRules->isContactFormWidgetEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderContactFormWidget');"));
}
if($displayRules->isLoginWidgetSmallEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderLoginWidget');"));
}
if($displayRules->isMoreInfoEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderMoreInfoWidget');"));
}
if($displayRules->isMoreInfoEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderValuationWidget');"));
}
if($displayRules->isAgentBioWidgetEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderAgentBioWidget');"));
}
if($displayRules->isSocialEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderSocialWidget');"));
}
if($displayRules->isHotsheetListWidgetEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderHotsheetListWidget');"));
}
if($displayRules->isEmailSignupWidgetEnabled()) {
	add_action("widgets_init", create_function("", "return register_widget('iHomefinderEmailSignupFormWidget');"));
}

//AJAX request handling
add_action("wp_ajax_nopriv_ihf_more_info_request", array($ajaxHandler, "requestMoreInfo"));
add_action("wp_ajax_nopriv_ihf_schedule_showing", array($ajaxHandler, "scheduleShowing"));
add_action("wp_ajax_nopriv_ihf_save_property", array($ajaxHandler, "saveProperty"));
add_action("wp_ajax_nopriv_ihf_photo_tour", array($ajaxHandler, "photoTour"));
add_action("wp_ajax_nopriv_ihf_save_search", array($ajaxHandler, "saveSearch"));
add_action("wp_ajax_nopriv_ihf_lead_capture_login", array($ajaxHandler, "leadCaptureLogin"));
add_action("wp_ajax_nopriv_ihf_saved_listing_comments", array($ajaxHandler, "addSavedListingComments"));
add_action("wp_ajax_nopriv_ihf_saved_listing_rating", array($ajaxHandler, "addSavedListingRating"));
add_action("wp_ajax_nopriv_ihf_save_listing_subscriber_session", array($ajaxHandler, "saveListingForSubscriberInSession"));
add_action("wp_ajax_nopriv_ihf_save_search_subscriber_session", array($ajaxHandler, "saveSearchForSubscriberInSession"));
add_action("wp_ajax_nopriv_ihf_contact_form_request", array($ajaxHandler, "contactFormRequest"));
add_action("wp_ajax_nopriv_ihf_send_password", array($ajaxHandler, "sendPassword"));
add_action("wp_ajax_nopriv_ihf_email_alert_popup", array($ajaxHandler, "emailAlertPopup"));
add_action("wp_ajax_nopriv_ihf_email_listing", array($ajaxHandler, "emailListing"));
add_action("wp_ajax_nopriv_ihf_email_board_member", array($ajaxHandler, "emailBoardMember"));
add_action("wp_ajax_nopriv_ihf_email_board_office", array($ajaxHandler, "emailBoardOffice"));
add_action("wp_ajax_nopriv_ihf_email_signup", array($ajaxHandler, "emailSignup"));
add_action("wp_ajax_nopriv_ihf_clear_cache", array($ajaxHandler, "clearCache"));
add_action("wp_ajax_nopriv_ihf_advanced_search_multi_selects", array($ajaxHandler, "advancedSearchMultiSelects")); //@deprecated
add_action("wp_ajax_nopriv_ihf_advanced_search_fields", array($ajaxHandler, "getAdvancedSearchFormFields")); //@deprecated
add_action("wp_ajax_nopriv_ihf_area_autocomplete", array($ajaxHandler, "getAutocompleteMatches")); //@deprecated

add_action("wp_ajax_ihf_more_info_request", array($ajaxHandler, "requestMoreInfo"));
add_action("wp_ajax_ihf_schedule_showing", array($ajaxHandler, "scheduleShowing"));
add_action("wp_ajax_ihf_save_property", array($ajaxHandler, "saveProperty"));
add_action("wp_ajax_ihf_photo_tour", array($ajaxHandler, "photoTour"));
add_action("wp_ajax_ihf_save_search", array($ajaxHandler, "saveSearch"));
add_action("wp_ajax_ihf_lead_capture_login", array($ajaxHandler, "leadCaptureLogin"));
add_action("wp_ajax_ihf_saved_listing_comments", array($ajaxHandler, "addSavedListingComments"));
add_action("wp_ajax_ihf_saved_listing_rating", array($ajaxHandler, "addSavedListingRating"));
add_action("wp_ajax_ihf_save_listing_subscriber_session", array($ajaxHandler, "saveListingForSubscriberInSession"));
add_action("wp_ajax_ihf_save_search_subscriber_session", array($ajaxHandler, "saveSearchForSubscriberInSession"));
add_action("wp_ajax_ihf_contact_form_request", array($ajaxHandler, "contactFormRequest"));
add_action("wp_ajax_ihf_send_password", array($ajaxHandler, "sendPassword"));
add_action("wp_ajax_ihf_email_alert_popup", array($ajaxHandler, "emailAlertPopup"));
add_action("wp_ajax_ihf_email_listing", array($ajaxHandler, "emailListing"));
add_action("wp_ajax_ihf_email_board_member", array($ajaxHandler, "emailBoardMember"));
add_action("wp_ajax_ihf_email_board_office", array($ajaxHandler, "emailBoardOffice"));
add_action("wp_ajax_ihf_email_signup", array($ajaxHandler, "emailSignup"));
add_action("wp_ajax_ihf_clear_cache", array($ajaxHandler, "clearCache"));
add_action("wp_ajax_ihf_tiny_mce_shortcode_dialog", array($shortcodeSelector, "getShortcodeSelectorContent"));
add_action("wp_ajax_ihf_advanced_search_multi_selects", array($ajaxHandler, "advancedSearchMultiSelects")); //@deprecated
add_action("wp_ajax_ihf_advanced_search_fields", array($ajaxHandler, "getAdvancedSearchFormFields")); //@deprecated
add_action("wp_ajax_ihf_area_autocomplete", array($ajaxHandler, "getAutocompleteMatches")); //@deprecated

//Disable canonical urls, because we use a single page to display all results and WordPress creates a single canonical url for all of the virtual urls like the detail page and featured results.
remove_action("wp_head", "rel_canonical");

add_action("template_redirect", array($enqueueResource, "outputHttpHeaders"));
add_action("template_redirect", array($enqueueResource, "outputHttpsStatus"));
