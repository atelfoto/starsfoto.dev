<?php // $this->Html->meta('description', $this->Text->truncate(strip_tags($page['Post']['content']), 160), array('inline' => false)); ?>
<?php echo  $this->set('title_for_layout',__("sitemap"));
//echo $this->Html->meta(array('name' => 'robots', 'content' => $menu['Menu']['robots']),NULL,array("inline"=>false));
$this->Html->addCrumb(__('sitemap'));
?>
<div class="container container-<?php echo 'sitemap'; ?>">
<div class="col-md-10 col-md-offset-1 page-content">
<div class="row">
<div class="col-md-5 col-md-offset-1" class="text-center">
<h3> <?php echo $this->Html->link(__("home"), array('controller' => 'pages', 'action' => 'index'),
array("title"=>__("home"),"data-toggle"=>"tooltip" ,"data-placement"=>"top")); ?></h3>
</div>
<div class="col-md-5 col-md-offset-1">
<figure>
<?php // echo  $this->Html->image("2015/04/epee_m.jpg", array("class"=>"img-responsive thumbnail")); ?>
</figure>
</div>
</div>
<div class="row">
<div class="col-md-5 col-md-offset-1">
<figure>
<?php // echo  $this->Html->image("2015/04/p0701-0008_m.jpg", array("class"=>"img-responsive thumbnail")); ?>
</figure>
</div>
<div class="col-md-5 col-md-offset-1">

</div>
</div>
<div class="row">
<div class="col-md-5 col-md-offset-1">
<ol>
<li> <?php echo $this->Html->link("inicio", array('controller' => 'pages', 'action' => 'index')); ?></li>
<li> <?php echo $this->Html->link("servicios", array('controller' => 'pages', 'action' => 'servicios')); ?></li>
<?php  // foreach ($pages as $k => $post): ?>
<!-- <li>
<?php  // echo $this->Html->link($post['Post']['name'], array( 'action' =>$post['Post']['slug'])); ?>
</li> -->
<?php  // endforeach ?>
</ol>
</div>
<div class="col-md-5 col-md-offset-1">
<h3><?php echo $this->Html->link("galeria", array('controller' => 'portfolios', 'action' => 'index'),
array("title"=>__('Galeria'),"data-toggle"=>'tooltip','data-placement'=>"top")); ?></h3>
<ol><?php foreach ($portfolios as $k => $portfolio): ?>
<li> <?php echo $this->Html->link($portfolio['Portfolio']['name'], array('controller' => 'portfolios',
'action' => 'view',"slug"=>$portfolio['Portfolio']['slug'])); ?>
</li>
<?php endforeach ?>
</ol>
<h3>Autres</h3>
<ol>
<li> <?php echo $this->Html->link("mapa del sitio", array('controller' => 'pages', 'action' => 'sitemap')); ?></li>
<li> <?php echo $this->Html->link("contact", array('controller' => 'contacts', 'action' => 'index')); ?></li>
</ol>
</div>
</div>
</div>
</div>
