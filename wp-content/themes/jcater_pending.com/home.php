<?php get_header(); ?>
<div id="slideshow-wrapper">
   <div id="slideshow">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Slideshow') ) : ?><?php endif; ?>
   </div>  
	<div id="hp-cta-holder">
		<div class="container">
			
				<div id="hp-cta">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP CTA') ) : ?><?php endif; ?>
		        </div>    
			  
		</div>	
	</div>
</div>
<div id="property-cta-holder">
		 	<div id="prop-cta">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Property CTA') ) : ?><?php endif; ?>
			</div>
</div>
<div id="quick-search-holder">
	<div class="container">
			
						<div id="quick-search">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Quick Search') ) : ?>
						<?php endif; ?>
					</div>
				
	</div>	
</div>
<div id="hp-welcome-holder">
	<div class="container">
			
				<div id="hp-welcome">
	            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Welcome') ) : ?><?php endif; ?>
	            </div>	
	    	    
	</div> 
</div>	
<div id="hp-properties">
	  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Featured Properties') ) : ?><?php endif; ?>
</div> 
<div id="hp-testimonials-holder">
	<div class="container">
		
			<div id="hp-testimonials">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Testimonials') ) : ?><?php endif; ?>
            </div>	
    	    
	</div>
</div> 
<div id="hp-blog-holder">
	<div class="container">
		
			<div id="hp-blog">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HP Blog') ) : ?><?php endif; ?>
            </div>	
    	
	</div>
</div> 

<?php get_footer(); ?>
