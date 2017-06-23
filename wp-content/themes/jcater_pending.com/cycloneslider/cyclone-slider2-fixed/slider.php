<?php if(!defined('ABSPATH')) die('Direct access denied.'); ?>

<?php
// For description of variables go to: http://www.codefleet.net/cyclone-slider-2/#template-variables
?>
<div class="cycloneslider cycloneslider-template-fixed cycloneslider-width-<?php echo esc_attr( $slider_settings['width_management'] ); ?>"
    id="<?php echo esc_attr( $slider_html_id ); ?>"
    <?php echo 'style="width:'.esc_attr( $slider_settings['width'] ).'px"' ?>
    >
    <div class="cycloneslider-fixed-slides cycle-slideshow"
        data-cycle-allow-wrap="<?php echo esc_attr( $slider_settings['allow_wrap'] ); ?>"
        data-cycle-dynamic-height="<?php echo esc_attr( $slider_settings['dynamic_height'] ); ?>"
        data-cycle-auto-height="<?php echo esc_attr( $slider_settings['auto_height'] ); ?>"
        data-cycle-auto-height-easing="<?php echo esc_attr( $slider_settings['auto_height_easing'] ); ?>"
        data-cycle-auto-height-speed="<?php echo esc_attr( $slider_settings['auto_height_speed'] ); ?>"
        data-cycle-delay="<?php echo esc_attr( $slider_settings['delay'] ); ?>"
        data-cycle-easing="<?php echo esc_attr( $slider_settings['easing'] ); ?>"
        data-cycle-fx="<?php echo esc_attr( $slider_settings['fx'] ); ?>"
        data-cycle-hide-non-active="<?php echo esc_attr( $slider_settings['hide_non_active'] ); ?>"
        data-cycle-log="false"
        data-cycle-next="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-next"
        data-cycle-pager="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-pager"
        data-cycle-pause-on-hover="<?php echo esc_attr( $slider_settings['hover_pause'] ); ?>"
        data-cycle-prev="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-prev"
        data-cycle-slides="&gt; div"
        data-cycle-speed="<?php echo esc_attr( $slider_settings['speed'] ); ?>"
        data-cycle-swipe="<?php echo esc_attr( $slider_settings['swipe'] ); ?>"
        data-cycle-tile-count="<?php echo esc_attr( $slider_settings['tile_count'] ); ?>"
        data-cycle-tile-delay="<?php echo esc_attr( $slider_settings['tile_delay'] ); ?>"
        data-cycle-tile-vertical="<?php echo esc_attr( $slider_settings['tile_vertical'] ); ?>"
        data-cycle-timeout="<?php echo esc_attr( $slider_settings['timeout'] ); ?>"
        >
        <?php foreach($slides as $slide): ?>
            <?php if ( 'image' == $slide['type'] ) : ?>
                <div class="cycloneslider-fixed-slide cycloneslider-slide-image" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <?php if( 'lightbox' == $slide['link_target'] ): ?>
                        <a class="cycloneslider-caption-more magnific-pop" href="<?php echo esc_url( $slide['full_image_url'] ); ?>" alt="<?php echo $slide['img_alt'];?>">
                    <?php elseif ( '' != $slide['link'] ) : ?>
                        <?php if( '_blank' == $slide['link_target'] ): ?>
                            <a class="cycloneslider-caption-more" target="_blank" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php else: ?>
                            <a class="cycloneslider-caption-more" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php endif; ?>
                    <?php endif; ?>

                    <img src="<?php echo cyclone_slide_image_url($slide['id'], $slider_settings['width'], $slider_settings['height'], array('current_slide_settings'=>$slide, 'slideshow_settings'=>$slider_settings) ); ?>" alt="<?php echo $slide['img_alt'];?>" title="<?php echo $slide['img_title'];?>" />
                    
                    <?php if( 'lightbox' == $slide['link_target'] or ('' != $slide['link']) ) : ?>
                        </a>
                    <?php endif; ?>
					
					<?php if(!empty($slide['title']) or !empty($slide['description'])) : ?>
                        <div class="cycloneslider-caption">
                            <div class="cycloneslider-caption-title"><?php echo wp_kses_post( $slide['title'] );?></div>
                            <div class="cycloneslider-caption-description"><?php echo wp_kses_post( $slide['description'] );?></div>
                        </div>
                    <?php endif; ?>
					
                </div>
            <?php elseif ( 'youtube' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'vimeo' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'video' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'custom' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <?php echo wp_kses_post( $slide['custom'] ); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php if ($slider_settings['show_nav']) : ?>
    <div class="cycloneslider-pager"></div>
    <?php endif; ?>
    <?php if ($slider_settings['show_prev_next']) : ?>
    <a href="#" class="cycloneslider-prev"></a>
    <a href="#" class="cycloneslider-next"></a>
    <?php endif; ?>
</div>

<script type="text/javascript">

jQuery(document).ready(function(){
	
	FixedSlideshow("#"+"<?php echo esc_attr( $slider_html_id ); ?>");
	
	function FixedSlideshow(elem) {
		
		elem = jQuery(elem);
		
		( function() {
			
			prepareSlideshow();
	
			resizeSlideshow();
			jQuery(window).resize(resizeSlideshow);
			jQuery(window).scroll(function() {
				setTimeout(resizeSlideshow,1500);
			});
			
		})();
		
		function prepareSlideshow() {
		
			/* Convert images into backgrounds */
			elem.find("img").each( function(i,v) {
				var img = jQuery(v);
				img.addClass("hidden");
				img.after("<div class='cycloneslider-fixed-slide-image' style='background-image:url("+img.attr("src")+")'></div>");
			});
			
			/* Create placeholder */
			
			if ( jQuery(".cycloneslider-template-fixed-placeholder").length == 0 ) {
				var placeholder = jQuery("<div class='cycloneslider-template-fixed-placeholder'></div>");
				placeholder.css({
					width:'100%',
					height:'100%',
					position:'fixed',
					'z-index':-1,
					display:'block',
					opacity:0,
					top:0,
					left:0
				});
				jQuery("body").append(placeholder);
			}
		
		}
		
		function resizeSlideshow() {
			var windowW = jQuery(".cycloneslider-template-fixed-placeholder").width();
			var windowH = jQuery(".cycloneslider-template-fixed-placeholder").height();
			var wallW = <?php echo $slider_settings['width'] ?>;
			var wallH = <?php echo $slider_settings['height'] ?>;
			var proportion, elementHeight;

			if ((windowW / wallW) > (windowH / wallH)) {
				proportion = windowW / wallW;
				elementHeight = wallH * proportion;
				elem.find("img").width(windowW).height(elementHeight);
				elem.add( elem.find("img, .cycloneslider-fixed-slide, .cycloneslider-fixed-slides") ).width(windowW).height(elementHeight);
			} else {
				proportion = windowH / wallH;
				elementHeight = windowH;
				jQuery(".cycloneslider-template-fixed img").width(wallW * proportion).height(windowH);
				elem.add( elem.find("img, .cycloneslider-fixed-slide, .cycloneslider-fixed-slides") ).width(wallW * proportion).height(windowH);
			}
			
			elem.find("img").css({
				'margin-top': -(wallH * proportion - windowH) / 2 + 'px',
				'margin-left': -(wallW * proportion - windowW) / 2 + 'px'
			});
			
			/* Autoresize body */
			
			if ( jQuery("html").height() < windowH ) {
				jQuery("html,body").height(windowH);
			}
			else {
				jQuery("html,body").css({height:'auto'});
			};

		}
		
	}
	
	
    
	
		
});




</script>