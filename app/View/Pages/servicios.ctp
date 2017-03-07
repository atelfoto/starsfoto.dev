

<?php foreach ($pages as $page): ?>
	<h2> <?php echo $page['Post']['name'] ?></h2>
	<div>
		<?php echo $page['Post']['content'] ?>
	</div>

<?php endforeach ?>
