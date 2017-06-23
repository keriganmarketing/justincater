jQuery(document).ready(function(){


	function aiosFramePopUp(){

		jQuery('.aios-frame-popup, .aios-video-popup').aiosPopup({
		  disableOn: 700,
		  type: 'iframe',
		  mainClass: 'aiosp-fade',
		  removalDelay: 160,
		  preloader: false,

		  fixedContentPos: false
		});	
	}
	aiosFramePopUp()

	function aiosImagePopUp(){
		jQuery('.aios-image-popup').aiosPopup({
			type: 'image',
			closeOnContentClick: true,
			mainClass: 'aiosp-img-mobile',
			image: {
			verticalFit: true
			}
		});
	}
	aiosImagePopUp()

	function aiosContentPopup(){

		jQuery('.aios-content-popup').aiosPopup({
			type: 'inline',
			preloader: false,
			focus: '#username',
			modal: true,
			callbacks : {
				open : function(){
				   jQuery('.aiosp-content').addClass('aios-popup-body')
				 	jQuery('.aios-popup-body').append('<button title="%title%" type="button" class="aiosp-close">&#215;</button>')
				}
			}
		});
	}
	aiosContentPopup()

});






