<?php if (count($images)):
?>
	<table>
		<thead>
			<tr>
s				<th>ID</th>
				<th>filepath</th>
				<th>alt</th>
				<th>slug</th>
				<th>wordpress_id</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($images as $key => $image_array): 
			$product_images = $image_array["images"];
			?>
			<?php foreach ($product_images as $key => $image): ?>
			<tr>
				<td></td>
				<td><?php echo $image["filepath"] ?></td>
				<td><?php echo $image["alt"] ?></td>
				<td><?php echo $image["slug"] ?></td>
				<td><?php echo $image["wordpress_id"] ?></td>
			</tr>
			<?php endforeach ?>

		<?php endforeach ?>
		</tbody>
	</table>	
<?php endif ?>