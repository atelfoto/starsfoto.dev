<?php // $portfolios=$this->requestAction(array('controller'=>'portfolios','action'=>'sidebar',"admin"=>false)); ?>
<?php   $portfolios=$this->requestAction("portfolios/sidebar/sort:created/direction:asc/limit:5"); ?>
<?php  foreach ($portfolios as $k => $v): $v= current($v); ?>
	<?php  echo $this->Html->link($v['name'],$v['link'], array('escape'=>false)); ?>
<?php  endforeach ?>
<?php echo $this->Html->link('home', array('controller' => 'pages', 'action' => 'index')); ?>
<?php echo $this->Html->link('contact', array('controller' => 'pages', 'action' => 'contact')); ?>
