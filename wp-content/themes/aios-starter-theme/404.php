<?php 

	get_header(); 


	$fetched_val  = get_option('404_settings');



?>
<div id="<?php echo $fetched_val['error_template']; ?>">
	<article id="content" class="hfeed">
	
		<?php do_action('aios_starter_theme_before_inner_page_content') ?>

		<div class="error-page-content-wrapper">
			<div class="error-page-image-holder">
				<div class="error-page-image-left">
					<img style="max-width: 383px" src="<?php echo $fetched_val['photo_left'] ?>" alt="404 Page - Not Found">
				</div>
				<div class="error-page-image-right">
					<img style="max-width: 247px" src="<?php echo $fetched_val['photo_right'] ?>" alt="404 Page - Not Found">
				</div>
			</div>
			<div class="error-page-excerpt">
				<p><?php echo $fetched_val['error_verbiage'] ?></p>
			</div>

			<div class="error-page-cf-wrap">
				<?php 

					echo do_shortcode( stripslashes($fetched_val['error_form']) ); 

				 ?>
			</div>
			
		</div>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </article><!-- end #content -->
    
    <?php ( $fetched_val['error_template'] =="content-sidebar" ?  get_sidebar() : '' )  ?>	
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>