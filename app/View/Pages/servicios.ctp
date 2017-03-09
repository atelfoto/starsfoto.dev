<?php  echo $this->assign('title', __('servicios'));
echo $this->Html->meta('canonical', 'http://'.env("HTTP_HOST").'/servicios', array('rel'=>'canonical', 'type'=>null, 'title'=>null, 'inline' => false)
);
?>
<?php foreach ($pages as $page): ?>
	<div class="page-header">
		<h2> <?php echo $page['Post']['name'] ?></h2>
	</div>
	<div class="servicios">
		<?php echo $page['Post']['content'] ?>
	</div>
<?php endforeach ?>
