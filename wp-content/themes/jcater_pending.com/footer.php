		<?php if ( !is_home() ) : ?>
			<div class="clearfix"></div>
			</div><!-- end of #inner-page-wrapper .inner -->
			</div><!-- end of #inner-page-wrapper -->
		<?php endif ?>
	</main>
	<div id="footer-wrapper">
		<div class="container">
	  		<div class="row">
				<div id="footer-contact">
	            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Contact') ) : ?><?php endif; ?>
	            </div>	
	        </div>
	  	</div>        
		<div class="container">
	  		<div class="row">
			       <div id="footer-left" class="col-md-12">
			           <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'depth' => '1', 'menu_class' => 'footernav', 'menu' => 'Footer Nav'  ) ); ?>
						<div class="footer-copyright">Copyright <?php echo date('Y') ?> www.justincater.com. All rights reserved | <a href="<?php bloginfo("url") ?>/sitemap">Sitemap</a><br><?php echo do_shortcode("[agentimage_credits credits=\"Real Estate Website Design by <a target='_blank' href='https://www.agentimage.com' style='text-decoration: underline !important;font-weight:bold;color:#6b594d!important'><u>Agent Image</u></a>\" ]") ?>
						<!-- aios shortcode here -->
						</div> 
					</div>
				   <div class="footer-logos col-md-12">
			        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Logos') ) : ?><?php endif; ?>
			        </div> 	
		    </div>
		</div>
	</div>		
 </div><!-- end of #main-wrapper -->


	<?php wp_footer(); ?>
</body>
</html>
