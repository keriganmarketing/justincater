jQuery(document).ready( function() {

    // PARRALAX Scrolling
    //jQuery(window).scroll(function(){
     // if ( jQuery(window).scrollTop() > 1060) {
      //  jQuery("#hp-testimonials-holder").parallax("50%",0.1,true);
      //}
    //});
	
jQuery("#header-wrapper").offsetScrollForHeader({
	height:90
});

function fixedNav(){
     jQuery(window).scroll(function() {        
        if( jQuery(this).scrollTop()  > 0 ) {
         if (!jQuery('#header-wrapper').hasClass('fixed-nav')) {
            jQuery('#header-wrapper').addClass('fixed-nav');
         
         };        
       } else {
         if (jQuery('#header-wrapper').hasClass('fixed-nav')) {              
             jQuery('#header-wrapper').removeClass('fixed-nav');
			};
		 }
     });    
   }

  fixedNav()

    jQuery("#navi").navTabDoubleTap();
	jQuery(".cta").navTabDoubleTap();
  
    function BreadCrumbs(){
      jQuery('p.yoast-breadcrumbs').detach().prependTo('#content');
    }
    //BreadCrumbs()



//Main Navigation/
    jQuery.fn.slideFadeToggle  = function(speed, easing, callback) {
      return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    }; 

    jQuery('#navigation li').hover(function(){
        jQuery('> ul', this).stop(true,true).slideFadeToggle(500);
    },function(){
        jQuery('> ul', this).stop(true,true).slideFadeToggle(500);
    });

    jQuery(document).ready( function() {
       jQuery("#hp-cta a").anchorSingleTap();
       jQuery(".prop-cta a").anchorSingleTap();
    });

  //jQuery('.prop-cta a').click(function() {
   // jQuery(this).anchorSingleTap();
  //});

  //Testimonials SLICK
  jQuery('.slick-testimonials').slick({
    autoplay: true,
    arrows:false,
    dots: true,
    infinite: true,
    speed: 700,
    
  });    

//Featured Properties SLICK
    jQuery('.fp-slides').slick({
      autoplay: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      slidesToScroll: true,
      arrows: false,
      dots: false,
      pauseOnHover: true,
      speed: 300,
      infinite: true,
      responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              rows: 1
            }
          },
          {
            breakpoint: 481,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              rows: 1
            }
          }
        ]
    });
});