<?php // $portfolios=$this->requestAction(array('controller'=>'portfolios','action'=>'sidebar',"admin"=>false)); ?>
<?php   $portfolios=$this->requestAction("portfolios/sidebar/sort:created/direction:asc/limit:5"); ?>
<?php echo $this->Html->link('home', array('controller' => 'pages', 'action' => 'index')); ?>
<?php  foreach ($portfolios as $k => $v): $v= current($v); ?>
	<?php  echo $this->Html->link($v['name'],$v['link'], array('escape'=>false)); ?>
<?php  endforeach ?>
<?php echo $this->Html->link('servicios', array('controller' => 'pages', 'action' => 'servicios')); ?>
<?php echo $this->Html->link('contact', array('controller' => 'contacts', 'action' => 'index')); ?>
