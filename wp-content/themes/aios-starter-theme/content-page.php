<?php if(have_posts()) : ?>
		
	<?php while(have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</div>

	<?php endwhile; ?>

<?php endif; ?>