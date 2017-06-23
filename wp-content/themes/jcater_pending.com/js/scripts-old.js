jQuery(document).ready( function() {


  jQuery('.tab-btn-list').on('click','a',function(event){

     event.preventDefault();
     event.stopPropagation();


     if( jQuery(this).attr('href') == "#"  ) {

          var selectedBtn = jQuery(this).attr('class');


          jQuery('.tab-content-popup-list').find('.'+selectedBtn).show();

          setTimeout(function(){
            jQuery('.tab-content-popup-list').fadeIn();
          },500)

      }else {
   
         window.location= jQuery(this).attr('href');
      }
  });
    // PARRALAX Scrolling
    //jQuery(window).scroll(function(){
     // if ( jQuery(window).scrollTop() > 1060) {
      //  jQuery("#hp-testimonials-holder").parallax("50%",0.1,true);
      //}
    //});

  jQuery('.tab-content-popup-list').on('click','.pop-close',function(){
    jQuery(this).parent().fadeOut();
    jQuery(this).parent().parent().fadeOut();
  })


    jQuery("#navi").navTabDoubleTap();
  
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

 //Testimonials SLICK
  jQuery('.slick-testimonials').slick({
    autoplay: true,
    arrows:false,
    dots: true,
    infinite: true,
    speed: 300,
    fade: true,
    cssEase: 'linear'
  });    

 //Featured Properties SLICK
    jQuery('.property-slick-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        rows:4,
        autoplay: true,   
        dots: false,
        arrows:false,
        autoplaySpeed: 5000,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: false

          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    }); 
  jQuery(".footernav li").transpose();


});
