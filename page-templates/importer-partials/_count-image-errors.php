<?php
if (count($image_errors)): ?>
	<span class="label warning"><?php echo $key ?></span>
	<div class="callout">
		<?php 
		$i=0;
		foreach ($image_errors as $key => $file): $i++; ?>

			<div><?php 
			echo $file;//$i .') '.
			?></div>
		<?php endforeach ?>
	</div>		
<?php endif;