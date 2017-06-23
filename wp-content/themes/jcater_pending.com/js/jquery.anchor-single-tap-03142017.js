/*
 * jquery.anchor-single-tap.js v1.0.2
 * Description: Forces <a> tags to open after a single tap
 * Copyright: http://www.agentimage.com
 * License: Proprietary
 */
 
( function() {
	
	jQuery.fn.anchorSingleTap = function() {
		
		return jQuery(this).each( function(i,v) {
			new AnchorSingleTap( jQuery(v) );
		});
		
	}
	
	function AnchorSingleTap(elem,settings) {
		
		var that = this;
		
		that.target = jQuery(elem);
		that.ctrlActive = false;
		
		/* Only apply to <a> tags */
		if ( !that.target.is("a") ) { return; }
		
		/* Disable click event */
		that.target.on("click touchstart", function(e) {
			e.preventDefault();
			that.openLink();
		});
		
		
		/* Recognize CTRL+Click */
		jQuery(document).bind("keydown", function(e) {
			that.setCtrlActive(e);
		});
		jQuery(document).bind("keyup", function(e) {
			that.setCtrlInactive(e);
		});
		
	}
	
	AnchorSingleTap.prototype.setCtrlActive = function(e) {
		
		var that = this;
		
		if ( e.which == 17 ) {
			that.ctrlActive = true;
		}
		
	}
		
	AnchorSingleTap.prototype.setCtrlInactive = function(e) {
		
		var that = this;
		
		if ( e.which == 17 ) {
			that.ctrlActive = false;
		}
		
	}
	
	AnchorSingleTap.prototype.openLink = function() {
		
		var that = this;
		
		var a = that.target;
		var url = a.attr("href");
		var target = typeof a.attr("target") == 'undefined' ? '_self' : a.attr("target") ;

		if ( that.ctrlActive ) {
			target = "_blank";
		}

		window.open(url,target);	
	
	}

})();	
 