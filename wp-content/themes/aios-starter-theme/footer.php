	<?php if ( !is_home() ) : ?>
		<div class="clearfix"></div>
		</div><!-- end of #inner-page-wrapper .inner -->
		</div><!-- end of #inner-page-wrapper -->
	<?php endif ?>
	</main>

	<div class="aios-starter-theme-demo-footer outer aios-mobile-pack-hide">
		<div class="inner">
			<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'footernav', 'theme_location' => 'primary-menu','depth'=>1 ) ); ?>
			<div class="aios-starter-theme-demo-footer-copyright">
				&copy; <?php echo date('Y') ?> Agent Image. <?php echo do_shortcode("[agentimage_credits keyword='Real Estate Internet Marketing']") ?>
			</div>
		</div>
	</div>

	</div><!-- end of #main-wrapper -->


	<?php wp_footer(); ?>
</body>
</html>
