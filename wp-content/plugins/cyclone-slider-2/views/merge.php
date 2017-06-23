<?php if(!defined('ABSPATH')) die('Direct access denied.'); ?>

<div class="wrap">
	<h2><?php _e('Confirm Update', 'cyclone-slider-2'); ?></h2>
	<form method="post">
		<input type="hidden" name="<?php echo $nonce_name; ?>" value="<?php echo $nonce; ?>">
		<button class="button-primary" type="submit" name="submit" value="merge"><?php _e('Proceed', 'cyclone-slider-2'); ?></button>
	</form>
	
</div>