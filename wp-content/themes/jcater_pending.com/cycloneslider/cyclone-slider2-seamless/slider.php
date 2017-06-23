<?php if(!defined('ABSPATH')) die('Direct access denied.'); ?>

<?php
// For description of variables go to: http://www.codefleet.net/cyclone-slider-2/#template-variables
?>
<div class="cycloneslider cycloneslider-template-seamless cycloneslider-width-<?php echo esc_attr( $slider_settings['width_management'] ); ?>"
	style="height:<?php echo esc_attr( $slider_settings['height'] ) ?>px" 
    id="<?php echo esc_attr( $slider_html_id ); ?>">
    <div class="cycloneslider-slides cycle-slideshow"
        data-cycle-allow-wrap="<?php echo esc_attr( $slider_settings['allow_wrap'] ); ?>"
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
                <div class="cycloneslider-slide cycloneslider-slide-image" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <?php if( 'lightbox' == $slide['link_target'] ): ?>
                        <a class="cycloneslider-caption-more magnific-pop" href="<?php echo esc_url( $slide['full_image_url'] ); ?>" alt="<?php echo $slide['img_alt'];?>">
                    <?php elseif ( '' != $slide['link'] ) : ?>
                        <?php if( '_blank' == $slide['link_target'] ): ?>
                            <a class="cycloneslider-caption-more" target="_blank" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php else: ?>
                            <a class="cycloneslider-caption-more" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php endif; ?>
                    <?php endif; ?>
					
					<?php
						$atts = wp_get_attachment_image_src($slide['id'], 'cyclone-slider2-seamless-slide');
					?>
					<img src="<?php echo $atts[0] ?>" alt="<?php echo $slide['img_alt'];?>"/>
           
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

<script>

	jQuery(document).ready( function() {
		
		resizeSlideshow();
		jQuery(window).resize(resizeSlideshow);
		
		function resizeSlideshow() {
			var winW = jQuery(window).width() ? jQuery(window).width() : window.innerWidth;
			var winMinW = 1132;
			var imageOrigW = <?php echo esc_attr( $slider_settings['width'] ) ?>;
			var imageOrigH = <?php echo esc_attr( $slider_settings['height'] ) ?>;
			var customContainer = jQuery("#hero");
			
			var slideshowContainer = jQuery(".cycloneslider-template-seamless .cycle-slideshow");
			var slideshowElements = jQuery(".cycloneslider-template-seamless .cycle-slideshow, .cycloneslider-template-seamless .cycloneslider-slide, .cycloneslider-template-seamless .cycloneslider-slide img");

			/* If window width is less than image width */
			if (winW < imageOrigW && winW >= winMinW) {

				/* Center image */
				var offset = ((imageOrigW - winW) / 2) * -1;
				slideshowContainer.css("margin-left", offset + "px");

				/* Restore original height of containers */
				customContainer.add(slideshowContainer).add(slideshowElements).height(imageOrigH);


			} else if (winW < imageOrigW && winW < winMinW) {

				/* Center image */
				var offset = ((imageOrigW - winMinW) / 2) * -1;
				slideshowContainer.css("margin-left", offset + "px");

				/* Restore original height of containers */
				customContainer.add(slideshowContainer).add(slideshowElements).height(imageOrigH);

			} else {

				/* Reset image alignment */
				slideshowContainer.css("margin-left", "0");

				/* Enlarge containers to fit larger image */
				var slideshowHeight = (imageOrigH * winW) / imageOrigW;
				customContainer.add(slideshowContainer).add(slideshowElements).height(slideshowHeight);

			}
		}

		
	});

</script>